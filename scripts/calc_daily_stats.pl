#!/usr/bin/perl

use strict;
use warnings;

use DBI;
use DateTime;
use YAML::Tiny;
use Data::Dumper;

$|++;

my $config;

sub loadConfig {
    my ($file) = @_;

    my $yaml = YAML::Tiny->read($file);
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
    
    # Save
    print "\nSave activity stat";
    print "\n---------------";
    print "\nShares: $shares";
    print "\nClicks: $clicks";
    print "\nClicks/Shares: $clicks_shares";

    $query = "insert into
    stat_activity_daily (`date`, `clicks`, `shares`, `clicks_shares`)
    values($d_str_from, $clicks, $shares, $clicks_shares) 
    on duplicate key update
    clicks = values(clicks),
    shares = values(shares),
    clicks_shares = values(clicks_shares)";

    $dbl->do($query);

    return;
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

    # Save
    print "\nSave auditory stat";
    print "\n---------------";
    print "\nUsers: $users";
    print "\nAdverts: $adverts";
    print "\nAgents: $agents";

    $query = "insert into
    stat_auditory_daily (`date`, `users`, `adverts`, `agents`)
    values($d_str_from, $users, $adverts, $agents) 
    on duplicate key update
    users = values(users),
    adverts = values(adverts),
    agents = values(agents)";

    $dbl->do($query);

    return;
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
    my ($turnover, $revenue) = (int($turnover_points * $course), int($revenue_points * $course)); 

    # Save
    print "\nSave money stat";
    print "\n---------------";
    print "\nTurnover: $turnover ($turnover_points)";
    print "\nRevenue: $revenue ($revenue_points)";

    $query = "insert into
    stat_money_daily (`date`, `turnover`, `turnover_points`, `revenue`, `revenue_points`)
    values($d_str_from, $turnover, $turnover_points, $revenue, $revenue_points) 
    on duplicate key update
    turnover = values(turnover),
    turnover_points = values(turnover_points),
    revenue = values(revenue),
    revenue_points = values(revenue_points)";

    $dbl->do($query);

    return;
}

# MAIN

$config = loadConfig('/home/roma/adrriva/main/config/app.yml');

# Detect date
my $dt_to = DateTime->now();
my $dt_from = $dt_to->clone->subtract( days => 1 );

my $db_link = DBI->connect(
    'DBI:mysql:ADRRIVA:localhost', 
    'root', 
    'yfldjhtnhfdf'
);

$db_link->do("set names 'utf8'");

calcMoneyStat($db_link, $dt_from, $dt_to);
calcAuditoryStat($db_link, $dt_from, $dt_to);
calcActivityStat($db_link, $dt_from, $dt_to);

