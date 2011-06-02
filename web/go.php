<?php

    # DB
    $db['host'] = 'localhost';
    $db['user'] = 'root';
    $db['pass'] = 'yfldjhtnhfdf';
    $db['name'] = 'ADRRIVA';

    # GLOBAL VARS
    $GLOBALS["ua_cache_time"]    = 1 * 60 * 60;
    $GLOBALS["ua_live_time"]     = 24 * 60 * 60;
    $GLOBALS["ua_cookie_name"]   = 'ua_way';
    $GLOBALS["ua_cookie_secret"] = 'g@m0v@';
    $GLOBALS["ua_cookie_expire"] = 31 * 24 * 60 * 60;
    $GLOBALS["click_duration"]   = 20;
    $GLOBALS["site_url"]         = "http://193.169.33.196/adrriva_site/default/showError";
    $GLOBALS["adv_url"]          = "http://193.169.33.196/adrriva_site/default/showAdvertise";

    $GLOBALS["user_ad_status_work"] = 0;

    function checkRobots($ua_id) {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        
        if (preg_match('/facebook/', $agent)) {
            showAdvertise($ua_id);
        }

    }

    function checkRef($ref) {
        if (preg_match("#^(http://)?((my\.)?mail\.ru)|(facebook\.com)|(vk\.com)|(vkontakte\.ru)|(odnoklassniki\.ru)#", $ref)) {
            return 1;
        } else {
            redirectSite('incorrect_ref');
        }
    }

    function redirectSite($h) {
        error_log("error, redirect to site: $h");
        header('Location: '.$GLOBALS["site_url"].'?error='.$h);
        die;
    }

    function showAdvertise($ua_id) {
        error_log("welcome robot: $ua_id");
        header('Location: '.$GLOBALS["adv_url"].'?ua_id='.$ua_id);
        die;
    }

    function redirectUrl($url) {
        error_log("bye, redirect to $url");
        header('Location: '.$url);
        die;
    }

    function addCookie($ua_id, $ua_info = array()) {

        $cookie_str = '';
        foreach ($ua_info as $ua => $ua_time) {
            if ($ua_time > time() - $GLOBALS["ua_live_time"]) { 
                $cookie_str .= $ua.','.$ua_time.';'; 
            }
        }
    
        $cookie_str .= $ua_id.",".time().";";
        saveCookie($cookie_str);

        return 1;
    }

    function saveCookie($cookie_str) {
        $cookie_secret .= md5($cookie_str . $GLOBALS["ua_cookie_secret"]);

        $cookie_str .= '.'.$cookie_secret;

        $res = setcookie($GLOBALS["ua_cookie_name"], $cookie_str, time() + $GLOBALS["ua_cookie_expire"]);
    }

    function validCookie($cookie, $ua_id) {

        $tmp = explode(".", $cookie);

        $ua_info_str   = $tmp[0];
        $cookie_secret = $tmp[1];

        # Check cookie secret
        if ($cookie_secret == md5($ua_info_str . $GLOBALS["ua_cookie_secret"])) {

            # Valid cookie
            $ua_arr = explode(";", $ua_info_str);
            
            $new_cookie_str = "";
            $its_found = 0;
            $its_new   = 1;
            $last_click_time = 0;

            foreach ($ua_arr as $ua_info) {
                $ua = explode(",", $ua_info);

                if (!$ua[0] || !$ua[1])
                    continue;

                $its_new = 0;

                if ($ua[1] > $last_click_time) {
                    $last_click_time = $ua[1];
                }
                
                if ($ua[1] > time() - $GLOBALS["ua_live_time"]) {
                    if ($ua[0] == $ua_id) {
                        $new_cookie_str .= $ua[0].','.time().';';
                        $its_found = 1;
                    } else {
                        $new_cookie_str .= $ua[0].','.$ua[1].';';
                    }
                }
            }

            if (!$its_found) {
                $new_cookie_str .= $ua_id.",".time().";";
            }

            saveCookie($new_cookie_str);

            if ($last_click_time > time() - $GLOBALS['click_duration']) {
                error_log("user click to fast: ".(time() - $last_click_time));
                return;
            }

            if ($its_new) {
                return array(3, $last_click_time);
            }

            if ($its_found) {
                return array(1, $last_click_time);
            } else {
                return array(2, $last_click_time);
            }

        } else {
            # Invalid cookie
            error_log("invalid cookie");
            return;
        }
    }

    function getUaInfo($ua_id, $s, $db) {
        $memcache = new Memcache;
        $memcache->connect('localhost', 11211) or die ("Could not connect");

        # Get user, advertise info

        # Get info from cache
        $cache_str = $memcache->get("ua_".$ua_id);
        $ua_info   = array();

        if ($cache_str) {
            $res = explode("\0", $cache_str);

            error_log("read from mc: ua_$ua_id");

            if (count($res) != 6) {
                redirectSite("invalid_mc");
            }

            $ua_info['uid']       = $res[0];
            $ua_info['advert_id'] = $res[1];
            $ua_info['aid']       = $res[2];
            $ua_info['url']       = $res[3];
            $ua_info['secret']    = $res[4];
            $ua_info['status']    = $res[5];

        } else {
            # Get info from DB
            mysql_connect($db['host'], $db['user'], $db['pass']) or error_log("ERROR! MYSQL CONNECT PROBLEM");
            mysql_select_db($db['name']) or error_log("ERROR! MYSQL DB PROBLEM");

            error_log("read from db: ua_$ua_id");
            
            $ua_id = mysql_real_escape_string($ua_id);
            $query = "select user_id, advert_id, advertise_id, url, secret, status from user_advertise where id = $ua_id;";
            
            $res = mysql_query($query) or error_log("ERROR! QUERY PROBLEM: $query");

            if (!$res) {
                redirectSite("incorrect_ua");
            }

            $row = mysql_fetch_array($res);
            $ua_info['uid']       = $row['user_id'];
            $ua_info['advert_id'] = $row['advert_id'];
            $ua_info['aid']       = $row['advertise_id'];
            $ua_info['url']       = $row['url'];
            $ua_info['secret']    = $row['secret'];
            $ua_info['status']    = $row['status'];

            # Cache it
            $memcache->set(
                "ua_".$ua_id, 
                implode("\0", array($ua_info['uid'], $ua_info['advert_id'], $ua_info['aid'], $ua_info['url'], $ua_info['secret'], $ua_info['status'])), 
                $GLOBALS["ua_cache_time"]
            );
        }

        if ($s == $ua_info['secret']) {
            error_log("got success info for ua: $ua_id, status: ".$ua_info['status']);

            return $ua_info;
        } else {
            error_log("invalid secret $s != ".$ua_info['secret']);
            return;
        }
    }

    function checkCookie($ua_id, $ua_info) {
        $cookie = $_COOKIE[ $GLOBALS["ua_cookie_name"] ];

        $res           = array();
        $no_cookie     = 1;
        $invalid_click = 0;

        if ($cookie) {
            $res = validCookie($cookie, $ua_id);
            
            if (!$res) {
                # Invalid cookie (click protection)
                error_log("invalid cookie protection");
                redirectUrl($ua_info['url']);
            }

            error_log("cookie is valid for $ua_id");

            if ($res && ($res[0] == 1 || $res[0] == 2)) {
                $no_cookie = 0;
            }

        } else {
            error_log("user hasn't cookie, set for $ua_id");
            addCookie($ua_id);
        }

        error_log("cookie - nc: $no_cookie, lct: ".$res[1]);

        return array('no_cookie' => $no_cookie, 'last_click_time' => $res[1]);
    }

    function writeFastClick($db, $ua_id, $a_hash, $ua_info, $cookie_info) {
        mysql_connect($db['host'], $db['user'], $db['pass']) or error_log("ERROR! MYSQL CONNECT PROBLEM");
        mysql_select_db($db['name']) or error_log("ERROR! MYSQL DB PROBLEM");
        
        $now       = time();
        $ua_id     = mysql_real_escape_string($ua_id);
        $a_hash    = mysql_real_escape_string($a_hash);
        $ad_id     = $ua_info['aid'];
        $uid       = $ua_info['uid'];
        $advert_id = $ua_info['advert_id'];
        $ip        = sprintf("%u", ip2long( $_SERVER['REMOTE_ADDR'] ));
        $ref       = mysql_real_escape_string($_SERVER['HTTP_REFERER']);
        $lct       = $cookie_info['last_click_time'];
        $no_cookie = $cookie_info['no_cookie'];

        $query = "insert into `fast_click` (`time`, `ua_id`, `a_hash`, `ad_id`, `user_id`, `advert_id`, `ip`, `ref`, `last_click_time`, `no_cookie`) values (" .
        join(',',
            array(
                "'$now'", 
                "'$ua_id'", 
                "'$a_hash'", 
                "'$ad_id'", 
                "'$uid'", 
                "'$advert_id'", 
                "'$ip'", 
                "'$ref'", 
                "'$lct'", 
                "'$no_cookie'"
            )).");";

        mysql_query($query) or error_log("ERROR! QUERY PROBLEM: $query");

        error_log("save click for $ua_id ok!");
        
        return 1;
    }


    # MAIN 
    # ==============================

    # Get IN params
    $ua_id  = (int) $_GET['ua_id'];
    $a_hash = $_GET['a_hash'];
    $s      = $_GET['s'];

    error_log("click: $ua_id $a_hash $s");

    if (!$ua_id || !$a_hash || !$s) {
        redirectSite("not_enough_params");
    }

    # Robots check
    checkRobots($ua_id);

    $ref = $_SERVER['HTTP_REFERER'];

    # Check valid ref
    checkRef($ref);

    # Get User Advertise info
    $ua_info = getUaInfo($ua_id, $s, $db);

    if (!$ua_info) {
        redirectSite("unknown_ua");
    }

    if ($ua_info['status'] != $GLOBALS['user_ad_status_work']) {
        redirectSite("ua_block");
    }

    # Check cookie
    $cookie_info = checkCookie($ua_id, $ua_info);

    # Write to temp click table
    writeFastClick($db, $ua_id, $a_hash, $ua_info, $cookie_info);

    redirectUrl($ua_info['url']);
?>
