#!/usr/bin/perl

use strict;
use warnings;

use DBI;
use Data::Dumper;
use Cache::Memcached::Fast;
use Time::HiRes;
use Time::Local;
use YAML::Tiny;
use POSIX;

$|++;

# VARS 
# ====================================

my $agregation_interval = 30 * 24 * 60 * 60;
my $portion_size        = 5;

my $config;

# FUNCTIONS 
# ====================================

sub loadConfig {
    my ($file) = @_;

    my $yaml = YAML::Tiny->read($file);
    return $yaml;
}


sub checkFraud {
    my ($h) = @_;

    print "\n\tfraud check";

    # TODO: use get multi 
    my $memd = new Cache::Memcached::Fast({
        servers => [ { address => 'localhost:11211' } ],
    });

    my $res = $memd->get_multi(values %$h);

    my %ret_ids;
    my %uniq;
    foreach my $key (keys %$h) {
        if ((!$res->{ $h->{$key} } && !$uniq{ $h->{$key} }) || !$config->[0]{'all'}{'fraud_check'}) {
            $uniq{ $h->{$key} } = 1;
            $ret_ids{$key} = 1; 
        } else {
            print "\n\t\tclick $key - fraud check invalid!";
        }
    }

    $memd->set_multi( map { [$h->{$_}, 1, $config->[0]{'all'}{'fraud_wait_period'}] } keys %ret_ids ) if (%ret_ids);

    return \%ret_ids;
}

sub getActions {
    my ($dbl, $hashes) = @_;

    my $criteria_str = join(' or ', map { '(hash = "'.$_->{'hash'}.'" and ua_id = '.$_->{'ua_id'}.')' } @$hashes);

    my $query = "
        select id, hash, time, ua_id, cost, social_network 
        from action 
        where $criteria_str";

    my $eq = $dbl->prepare($query);
    $eq->execute;

    my %ret_actions;
    while (my ($id, $hash, $time, $ua_id, $cost, $network) = $eq->fetchrow_array) {
        $ret_actions{ $hash.'_'.$ua_id } = {
            'id'      => $id,
            'ua_id'   => $ua_id,
            'hash'    => $hash,
            'cost'    => $cost,
            'network' => $network,
        };
    }

    return \%ret_actions;
}

sub getAccounts {
    my ($dbl, $uids) = @_;

    my $query = "
        select id, user_id, balance, status 
        from account 
        where user_id in (".join(',', @$uids).");";

    my $eq = $dbl->prepare($query);
    $eq->execute;

    my %ret;
    while (my ($id, $user_id, $balance, $status) = $eq->fetchrow_array) {
        $ret{$user_id} = {
            'account' => $id,
            'balance' => $balance,
            'status'  => $status,
        };
    }

    return \%ret;
}

sub saveClick {
    my ($dbl, $info) = @_;

    my $clicker = '';
    if ($info->{'ref'} =~ m!my\.mail\.ru/(\w+)/(\S+)/!) {
        $clicker = $2."@".$1.".ru";
    }

    my $query = "
        insert into click 
        (time, processed, user_id, advert_id, clicker_email, ua_id, ad_id, aid, ip, ref, no_cookie, cost, social_network, status)
        values(".
            join(",", ("'".$info->{'time'}."'",
                "'".$info->{'processed'}."'",
                "'".$info->{'user_id'}."'",
                "'".$info->{'advert_id'}."'",
                $clicker ? "'$clicker'" : "''",
                "'".$info->{'ua_id'}."'",
                "'".$info->{'ad_id'}."'",
                "'".$info->{'action'}{'id'}."'",
                "'".$info->{'ip'}."'",
                "'".$info->{'ref'}."'",
                "'".$info->{'no_cookie'}."'",
                "'".$info->{'action'}{'cost'}."'",
                "'".$info->{'action'}{'network'}."'",
                "'".$config->[0]{'all'}{'click_status'}{'approved'}."'",
            ))
        .");";

    my $eq = $dbl->prepare($query);
    $eq->execute;

    return $dbl->{'insertid'};
}

sub createTransaction {
    my ($dbl, $click_id, $info, $account) = @_;

    $info->{'fee'}    = ceil($config->[0]{'all'}{'fee'} * $info->{'action'}{'cost'} / 100);
    $info->{'points'} = $info->{'action'}{'cost'} + $info->{'fee'};
    $info->{'amount'} = $info->{'action'}{'cost'};

    # Create transaction
    my $query = "insert into transaction
    (`points`, `amount`, `fee`, `from`, `to`, `from_user`, `to_user`, `invoice_id`, `created_at`)
    values(".
        join(",", (
            $info->{'points'},
            $info->{'amount'},
            $info->{'fee'},
            $info->{'advert_id'},
            $info->{'user_id'},
            $account->{ $info->{'advert_id'} }{'account'},
            $account->{ $info->{'user_id'} }{'account'}, 
            $click_id,
            "from_unixtime(".time().")"
        ))
    .");";

    my $eq = $dbl->prepare($query);
    $eq->execute;

    my $tid = $dbl->{'insertid'};

    print "\n\t\t\t\t$click_id ($tid): ".
        $info->{'points'}.", ".$info->{'fee'}.", ".$info->{'amount'};

    # Decrease advert balance
    $query = "update account set balance = balance - ".$info->{'points'}." where id = ".$account->{ $info->{'advert_id'} }{'account'};
    $eq = $dbl->prepare($query);
    $eq->execute;
    
    $account->{ $info->{'advert_id'} }{'balance'} -= $info->{'points'};

    # Increase agent balance
    $query = "update account set balance = balance + ".$info->{'amount'}." where id = ".$account->{ $info->{'user_id'} }{'account'};
    $eq = $dbl->prepare($query);
    $eq->execute;

    return $tid;
}

sub checkAccount {
    my ($dbl, $account, $info) = @_;

    if ($account->{ $info->{'advert_id'} }{'balance'} < $info->{'action'}{'cost'}) {

        # Block advert account and advertise
        # switch it on (debug now)
        blockAccount($dbl, $account->{ $info->{'advert_id'} }{'account'}, $info->{'advert_id'});
        
        return 0;
    
    } else {
        return 1;
    }
}

sub blockAccount {
    my ($dbl, $id, $advert_id) = @_;

    print "\nblock account: $id (advert: $advert_id)";

    # Block account
    my $query = "update account set status = ".$config->[0]{'all'}{'account_status'}{'block'}." where id = $id";
    my $eq = $dbl->prepare($query);
    $eq->execute;

    # Block advertise
    $query = "update advertise set status = ".$config->[0]{'all'}{'advertise_status'}{'money_block'}." where owner_id = $advert_id";
    $eq = $dbl->prepare($query);
    $eq->execute;

    # Drop memcache
    my $memd = new Cache::Memcached::Fast({
        servers => [ { address => 'localhost:11211' } ],
    });

    $query = "select id from user_advertise where advert_id = $advert_id";
    $eq = $dbl->prepare($query);
    $eq->execute;

    my %ret_actions;
    while (my ($ua_id) = $eq->fetchrow_array) {
        my $res = $memd->delete('ua_'.$ua_id);
    }
    
    # Block user_advertise
    $query = "update user_advertise set status = ".$config->[0]{'all'}{'user_ad_status'}{'advert_block'}." where advert_id = $advert_id";
    $eq = $dbl->prepare($query);
    $eq->execute;

    # TODO: Send email

    return 1;
}

sub saveAdvertStatistics {
    my ($dbl, $advert_id, $ad_id, $points) = @_;

    my $query = "insert into stat_advert_daily (`date`, `advert_id`, `ad_id`, `points`, `clicks`) 
        values(now(), $advert_id, $ad_id, $points, 1) on duplicate key update 
        clicks = clicks + 1,
        points = points + $points";
    my $eq = $dbl->prepare($query);
    $eq->execute;

    return 1;
}

sub saveAgentStatistics {
    my ($dbl, $user_id, $ua_id, $points) = @_;

    my $query = "insert into stat_agent_daily (`date`, `user_id`, `ua_id`, `points`, `clicks`) 
        values(now(), $user_id, $ua_id, $points, 1) on duplicate key update 
        clicks = clicks + 1,
        points = points + $points";
    my $eq = $dbl->prepare($query);
    $eq->execute;

    return 1;
}


sub saveGlobalStatistics {
    my ($dbl, $points, $fee) = @_;

    my $query = "insert into stat_global_hours (`date_hour`, `points`, `clicks`, `fee`) 
        values(date_format(now(), '%Y-%m-%d %H:00:00'), $points, 1, $fee) on duplicate key update 
        clicks = clicks + 1,
        fee = fee + $fee,
        points = points + $points";
    my $eq = $dbl->prepare($query);
    $eq->execute;

    return 1;
}

sub cleanFastClicksTable {
    my ($dbl, $start_time) = @_;

    my $query = "delete from fast_click where time < $start_time";
    my $eq = $dbl->prepare($query);
    $eq->execute;

    return 1;
}

sub processPortion {
    my ($db_link, $portion, $start_time) = @_;

    my %to_fraud_check;
    my %to_account_get;
    my @to_actions_get;

    # Prepare data
    print "\n\tprepare data";

    foreach my $click (@$portion) {
        
        my ($id, $time, $ua_id, $a_hash, $ad_id, $user_id, 
            $advert_id, $ip, $ref, $lc_time, $no_cookie) = @$click;
        
        $to_fraud_check{$id} = $ua_id.'_'.$ip;
        $to_account_get{ $user_id } = 1;
        $to_account_get{ $advert_id } = 1;

        push(@to_actions_get, { 'hash' => $a_hash, 'ua_id' => $ua_id });
    };

    my $approved_ids = checkFraud( \%to_fraud_check );
    my $actions      = getActions( $db_link, \@to_actions_get );
    my $user_account = getAccounts( $db_link, [ keys %to_account_get ] );

    print "\n\tapproved ".scalar(keys %$approved_ids)." clicks...";

    # Process clicks
    foreach my $click (@$portion) {
        processClick($db_link, $click, $start_time, $approved_ids, $actions, $user_account); 
    }

    return 1;
}

sub processClick {
    my ($db_link, $click, $start_time, $approved_ids, $actions, $user_account) = @_;

    my ($id, $time, $ua_id, $a_hash, $ad_id, $user_id, 
        $advert_id, $ip, $ref, $lc_time, $no_cookie) = @$click;
    
    print "\n\t\tprocess click $id ($ua_id, $a_hash, $ad_id, $time)";

    return if (!defined($approved_ids->{$id}));
    print "\n\t\tclick - approved; ";
    return if (!defined($actions->{$a_hash.'_'.$ua_id}));
    print "action - ok; ";
    print "network: ".$actions->{$a_hash.'_'.$ua_id}{'network'}."; ";
    return if ($user_account->{ $advert_id }{'status'} != $config->[0]{'all'}{'account_status'}{'work'});
    print "user account - ok; ";

    print "\n\t\t\tclick $id: verified success";

    my $info = {
            'time'      => $time,
            'processed' => $start_time,
            'ua_id'     => $ua_id,
            'action'    => $actions->{ $a_hash.'_'.$ua_id },
            'ad_id'     => $ad_id,
            'user_id'   => $user_id,
            'advert_id' => $advert_id,
            'ip'        => $ip,
            'ref'       => $ref,
            'no_cookie' => $no_cookie,
    };

    # Check account
    my $is_work_account = checkAccount($db_link, $user_account, $info);
    return if (!$is_work_account);

    print "\n\t\t\tclick $id: account balance ok";

    # Write to clicks table
    my $click_id;
    eval {
        $click_id = saveClick($db_link, $info);
    };

    if (!$click_id) {
        warn "\n\t\t\tclick $id: error - can't save in db: ".$@;
        return;
    }

    # Create transaction
    my $transaction_id = createTransaction($db_link, $click_id, $info, $user_account);

    print "\n\t\t\tclick $id: transaction $transaction_id created";
    
    # Write to statistic
    saveAdvertStatistics($db_link, $info->{'advert_id'}, $info->{'ad_id'}, $info->{'points'});
    saveAgentStatistics($db_link, $info->{'user_id'}, $info->{'ua_id'}, $info->{'amount'});            
    saveGlobalStatistics($db_link, $info->{'points'}, $info->{'fee'});

    print "\n\t\t\tclick $id: save info in statistics";

    return 1;
}

# MAIN
# ====================================

my $start_time = time();
my $all_start_time = Time::HiRes::time();

print "Start click processing at ".localtime($start_time)." ($start_time)";

$config = loadConfig('/home/roma/adrriva/main/config/app.yml');

my $db_link = DBI->connect(
    'DBI:mysql:ADRRIVA:localhost', 
    'root', 
    'yfldjhtnhfdf'
);

$db_link->do("set names 'utf8'");

my $query = "
    select id, time, ua_id, a_hash, ad_id, user_id, advert_id, ip, ref, last_click_time, no_cookie 
    from fast_click
    where time > ".($start_time - $agregation_interval).";";
my $fq = $db_link->prepare($query);
$fq->execute;

my $i = 0;
my @to_processing;
while (my @click_info = $fq->fetchrow_array) {

    $i++;
    push(@to_processing, \@click_info);

    if ($i % $portion_size == 0) {
        print "\n$i. Process portion at ".localtime($start_time)." ($start_time)";
        my $portion_start = Time::HiRes::time();
        processPortion($db_link, \@to_processing, $start_time);        
        @to_processing = ();
        my $portion_duration = Time::HiRes::time() - $portion_start;
        print "\n$i. Portion processed at ".localtime($start_time)." ($start_time), duration: ".sprintf("%.2f", $portion_duration)." sec";
    }
}

if (scalar(@to_processing) > 0) {
    print "\n$i. Process last portion at ".localtime($start_time)." ($start_time)";
    my $portion_start = Time::HiRes::time();
    processPortion($db_link, \@to_processing, $start_time);        
    my $portion_duration = Time::HiRes::time() - $portion_start;
    print "\n$i. Portion processed at ".localtime($start_time)." ($start_time), duration: ".sprintf("%.2f", $portion_duration)." sec";
}

# Clean Table
cleanFastClicksTable($db_link, $start_time);
print "\nTable fast_clicks cleaned";

my $all_duration = Time::HiRes::time() - $all_start_time;
print "\nFinish click processing at ".localtime($start_time)." ($start_time)";
print "\nDuration: ".sprintf("%.2f", $all_duration)." sec";

