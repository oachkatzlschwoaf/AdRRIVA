<?php

class AgentLastActionPeer extends BaseAgentLastActionPeer {

    public function setUserInfo($v) {
        $this->user_info = $v;

        $sorted_ua = array();
        $sorted_sn = array();
        $this->last_action_time = 0;

        foreach ($v as $row) {
            $at = $row->getActionTime('U');

            if (!isset($sorted_ua[ $row->getUaId() ])) {
                $sorted_ua[ $row->getUaId() ] = array();
                $sorted_ua[ $row->getUaId() ]['action'] = 0;
                $sorted_ua[ $row->getUaId() ]['network'] = array();
            }

            if (!isset($sorted_sn[ $row->getSocialNetwork() ])) {
                $sorted_sn[ $row->getSocialNetwork() ] = 0;
            }

            if ($at > $sorted_ua[ $row->getUaId() ]['action']) {
                $sorted_ua[ $row->getUaId() ]['action'] = $at;
            }

            if ($at > $sorted_sn[ $row->getSocialNetwork() ]) {
                $sorted_sn[ $row->getSocialNetwork() ] = $at;
            }

            if (!isset($sorted_ua[ $row->getUaId() ]['network'][ $row->getSocialNetwork() ])) {
                $sorted_ua[ $row->getUaId() ]['network'][ $row->getSocialNetwork() ] = 0;
            }

            if ($at > $sorted_ua[ $row->getUaId() ]['network'][ $row->getSocialNetwork() ]) {
                $sorted_ua[ $row->getUaId() ]['network'][ $row->getSocialNetwork() ] = $at;
            }

            if ($at > $this->last_action_time) {
                $this->last_action_time = $at;
            }
        }

        $this->sorted_ua = $sorted_ua;
        $this->sorted_sn = $sorted_sn;

        return $this;
    }

    public function getUserLastActionTime() {
        return $this->last_action_time;
    }

    public function getUaSortedInfo() {
        return $this->sorted_ua;
    }

    public function getNetworkSortedInfo() {
        return $this->sorted_sn;
    }

    public function getAllUserInfo() {

        $user = sfContext::getInstance()->getUser();
        $uid = $user->getAttribute('id');

        $rl_c = new Criteria();
        $rl_c->add(AgentLastActionPeer::USER_ID, $uid);
        $times = AgentLastActionPeer::doSelect( $rl_c );

        $this->setUserInfo( $times ); 
    }

    public function getUaLastTime() {

    }

    public function checkUaRateLimit($ua, $network = null) {
        if (!sfConfig::get('app_rate_limit_check'))
            return;

        $util = new Util;
        $info = $this->getUaSortedInfo();

        # Check social network rate limit
        if (isset($network)) {
            $sn_info = $this->getNetworkSortedInfo();

            $sn = sfConfig::get('app_social_network_'.$network);

            $s_lat = 0;
            if (isset($sn_info[$sn])) { 
                $s_lat = $sn_info[$sn];
            } 

            if ((time() - $s_lat) < sfconfig::get('app_rate_limit_network')) {

                $diff = $s_lat + sfconfig::get('app_rate_limit_network') - time();
                $grl_hours = floor( $diff / (60 * 60) ); 
                $grl_min = floor(($diff - $grl_hours * 60 * 60) / 60) + 1; 

                return ($grl_hours > 0 ? $util->declension($grl_hours, array('час', 'часа', 'часов'), 1) : "")
                    ." ".$util->declension($grl_min, array("минуту", "минуты", "минут"), 1);
                 
            }
        }

        # Check user advertise rate limit
        $ua_lat = 0;
        if (isset($info[ $ua->getId() ]['action'])) {
            $ua_lat = $info[ $ua->getId() ]['action'];
        }

        if ((time() - $ua_lat) < sfconfig::get('app_rate_limit_ua')) {

            $diff = $ua_lat + sfconfig::get('app_rate_limit_ua') - time();
            $grl_hours = floor( $diff / (60 * 60) ); 
            $grl_min = floor(($diff - $grl_hours * 60 * 60) / 60) + 1; 

            return ($grl_hours > 0 ? $util->declension($grl_hours, array('час', 'часа', 'часов'), 1) : "")
                ." ".$util->declension($grl_min, array("минуту", "минуты", "минут"), 1);
             
        }

        # Check stream rate limit
        $u_lat = $this->getUserLastActionTime();

        if ((time() - $u_lat) < sfconfig::get('app_rate_limit_stream')) {

            $diff = $u_lat + sfconfig::get('app_rate_limit_stream') - time();
            $grl_hours = floor( $diff / (60 * 60) ); 
            $grl_min = floor(($diff - $grl_hours * 60 * 60) / 60) + 1; 

            return ($grl_hours > 0 ? $util->declension($grl_hours, array('час', 'часа', 'часов'), 1) : "")
                ." ".$util->declension($grl_min, array("минуту", "минуты", "минут"), 1);

        }

    }

} // AgentLastActionPeer
