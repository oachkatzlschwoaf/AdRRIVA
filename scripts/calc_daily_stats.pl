#!/usr/bin/perl

use strict;
use warnings;

use DBI;
use DateTime;
use YAML::Tiny;
use Net::SMTP;
use Data::Dumper;
use Getopt::Long;
use MIME::Lite; 

$|++;

my $config;
my $db_config;

sub loadConfig {
    my ($file, $options) = @_;

    my $yaml;
    if ($options->{'encode_brackets'}) {

        my $fp;
        open $fp, $file;
        my $yaml_str = '';
        $yaml_str .= $_ while (<$fp>); 
        close $fp;
    
        $yaml_str =~ s/{/'{/gm;
        $yaml_str =~ s/}/}'/gm;

        $yaml = YAML::Tiny->read_string($yaml_str);

    } else {
        $yaml = YAML::Tiny->read($file);
    }

    return $yaml;
}

sub calcActivityStat {
    my ($dbl, $from, $to) = @_;

    my $d_str_from = $dbl->quote($from->ymd('-'));
    my $d_str_to   = $dbl->quote($to->ymd('-'));

    
    # Shares
    
    my $query = "select count(id) shares from action where time > ".$from->epoch()." and time < ".$to->epoch().";";
    my $eq = $dbl->prepare($query);
    $eq->execute;

    my ($shares) = $eq->fetchrow_array;

    # Clicks

    $query = "select count(id) clicks from click where time > ".$from->epoch()." and time < ".$to->epoch().";";
    $eq = $dbl->prepare($query);
    $eq->execute;

    my ($clicks) = $eq->fetchrow_array;

    # Clicks / Shares

    my $clicks_shares = $shares ? sprintf("%.2f", ($clicks / $shares)) : 0;

    # Advertise in catalog
    $query = "select count(id) clicks from advertise where status = ".
        $config->[0]{'all'}{'advertise_status'}{'work'};
    $eq = $dbl->prepare($query);
    $eq->execute;

    my ($advertise_catalog) = $eq->fetchrow_array;
    
    # Do Report 
    my $report = '';
    $report .= "\n\nActivity statistic";
    $report .= "\n-------------------";
    $report .= "\nShares: $shares";
    $report .= "\nClicks: $clicks";
    $report .= "\nClicks/Shares: $clicks_shares";
    $report .= "\nAdvertise in catalog: $advertise_catalog";

    # Save stat
    $query = "insert into
    stat_activity_daily (`date`, `clicks`, `shares`, `clicks_shares`, `advertise_catalog`)
    values($d_str_from, $clicks, $shares, $clicks_shares, $advertise_catalog) 
    on duplicate key update
    clicks = values(clicks),
    shares = values(shares),
    clicks_shares = values(clicks_shares),
    advertise_catalog = values(advertise_catalog)";

    $dbl->do($query);

    return $report;
}

sub calcAuditoryStat {
    my ($dbl, $from, $to) = @_;

    my $d_str_from = $dbl->quote($from->ymd('-'));
    my $d_str_to   = $dbl->quote($to->ymd('-'));

    # Users

    my $query = "select count(id) users from user;";
    my $eq = $dbl->prepare($query);
    $eq->execute;

    my ($users) = $eq->fetchrow_array;

    # Adverts

    $query = "select count(id) adverts from user where role = ".$config->[0]{'all'}{'user_role'}{'advert'}.";";
    $eq = $dbl->prepare($query);
    $eq->execute;

    my ($adverts) = $eq->fetchrow_array;

    # Agents

    $query = "select count(id) agents from user where role = ".$config->[0]{'all'}{'user_role'}{'agent'}.";";
    $eq = $dbl->prepare($query);
    $eq->execute;

    my ($agents) = $eq->fetchrow_array;

    # Do report 
    my $report = '';
    $report .= "\n\nAuditory statistic";
    $report .= "\n-------------------";
    $report .= "\nUsers: $users";
    $report .= "\nAdverts: $adverts";
    $report .= "\nAgents: $agents";

    # Save stat
    $query = "insert into
    stat_auditory_daily (`date`, `users`, `adverts`, `agents`)
    values($d_str_from, $users, $adverts, $agents) 
    on duplicate key update
    users = values(users),
    adverts = values(adverts),
    agents = values(agents)";

    $dbl->do($query);

    return $report;
}

sub calcMoneyStat {
    my ($dbl, $from, $to) = @_;
    
    my $d_str_from = $dbl->quote($from->ymd('-'));
    my $d_str_to   = $dbl->quote($to->ymd('-'));

    my $course = $config->[0]{'all'}{'point_ruble_course'};
    
    # Turnover, Revenue

    my $query = "
    select sum(points) points, sum(fee) fee
    from transaction
    where created_at > $d_str_from and created_at < $d_str_to;";

    my $eq = $dbl->prepare($query);
    $eq->execute;

    my ($turnover_points, $revenue_points) = $eq->fetchrow_array;
    $turnover_points ||= 0;
    $revenue_points  ||= 0;

    my ($turnover, $revenue) = (int($turnover_points * $course), int($revenue_points * $course)); 
    $turnover        ||= 0;
    $revenue         ||= 0;

    # Do report
    my $report = '';
    $report .= "\n\nMoney statistic";
    $report .= "\n-------------------";
    $report .= "\nTurnover: $turnover ($turnover_points)";
    $report .= "\nRevenue: $revenue ($revenue_points)";

    # Save stat
    $query = "insert into
    stat_money_daily (`date`, `turnover`, `turnover_points`, `revenue`, `revenue_points`)
    values($d_str_from, $turnover, $turnover_points, $revenue, $revenue_points) 
    on duplicate key update
    turnover = values(turnover),
    turnover_points = values(turnover_points),
    revenue = values(revenue),
    revenue_points = values(revenue_points)";

    $dbl->do($query);

    return $report;
}

# MAIN
my ($days, $app_path, $db_path, $env);

GetOptions(
    "days=s"     => \$days,
    "app_path=s" => \$app_path,
    "db_path=s"  => \$db_path,
    "env=s"      => \$env,
);

$app_path ||= '/home/roma/adrriva/site/config/app.yml';
$db_path  ||= '/home/roma/adrriva/site/config/databases.yml';

$config    = loadConfig($app_path);
$db_config = loadConfig($db_path, { 'encode_brackets' => 1 });
$env ||= 'all';
$days    = 1;

my $dsn     = $db_config->[0]{$env}{'propel'}{'param'}{'dsn'};
my $db_user = $db_config->[0]{$env}{'propel'}{'param'}{'username'};
my $db_pass = $db_config->[0]{$env}{'propel'}{'param'}{'password'};

# Detect date
my $dt_to = DateTime->now();
my $dt_from = $dt_to->clone->subtract( days => $days );

my $db_link = DBI->connect(
    'DBI:'.$dsn, 
    $db_user, 
    $db_pass 
);

$db_link->do("set names 'utf8'");

my $money_report = calcMoneyStat($db_link, $dt_from, $dt_to);
my $aud_report   = calcAuditoryStat($db_link, $dt_from, $dt_to);
my $act_report   = calcActivityStat($db_link, $dt_from, $dt_to);

my $report = join(" ", ($money_report, $aud_report, $act_report));

# Send email
my $msg = MIME::Lite->new(
    From    => 'support@adrriva.ru',
    To      => 'roman.olegovich.novikov@gmail.com',
    Subject => 'AdRRIVA Daily Report',
    Data    => $report 
);

$msg->send('smtp', 'mail.homestyle.ru', AuthUser => 'support@adrriva.ru', AuthPass => 'g6u2NXnmR');

