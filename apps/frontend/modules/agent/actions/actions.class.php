<?php

class agentActions extends sfActions {

    public function _get_statistics() {

        # Get statistic
        $ac_c = new Criteria();
        $ac_c->add(AccountPeer::USER_ID, $this->getUser()->getAttribute('id'));
        $this->account = AccountPeer::doSelectOne($ac_c);

        $ac_c = new Criteria();
        $ac_c->add(StatAgentDailyPeer::USER_ID, $this->getUser()->getAttribute('id'));
        $ac_c->add(StatAgentDailyPeer::DATE, time());
        $this->ad_stats = StatAgentDailyPeer::doSelect($ac_c);

        $seg_ad_stats = array();
        $this->total_clicks = 0;
        $this->total_points = 0;

        foreach ($this->ad_stats as $stat) {
            $seg_ad_stats[ $stat->getUaId() ] = $stat;

            $this->total_clicks += $stat->getClicks();
            $this->total_points += $stat->getPoints();
        }

        $this->seg_ad_stats = $seg_ad_stats;

    }

    private function _get_agent_statistics() {
        
        $days_interval = 30;

        # Get statistic
        $ac_c = new Criteria();
        $ac_c->add(AccountPeer::USER_ID, $this->getUser()->getAttribute('id'));
        $this->account = AccountPeer::doSelectOne($ac_c);

        $ac_c = new Criteria();
        $ac_c->add(StatAgentDailyPeer::USER_ID, $this->getUser()->getAttribute('id'));
        $ac_c->add(StatAgentDailyPeer::DATE, (time() - $days_interval * 24 * 60 * 60), Criteria::GREATER_THAN);
        $this->agent_stats = StatAgentDailyPeer::doSelect($ac_c);

        $stat_30d = array();
    
        foreach ($this->agent_stats as $stat) {
            if (!isset($stat_30d[ $stat->getDate() ]['clicks'])) 
                $stat_30d[ $stat->getDate() ]['clicks'] = 0;

            if (!isset($stat_30d[ $stat->getDate() ]['points'])) 
                $stat_30d[ $stat->getDate() ]['points'] = 0;

            $stat_30d[ $stat->getDate() ]['clicks'] += $stat->getClicks();
            $stat_30d[ $stat->getDate() ]['points'] += $stat->getPoints();
        }

        # Get 30d interval
        $from = time() - $days_interval * 24 * 60 * 60; 
        $prep_stat_30d = array();

        for ($i = 0; $i <= $days_interval; $i++) {
            $d = $from + $days_interval * 24 * 60 * 60 - $i * 24 * 60 * 60;
            $d_str = strftime("%Y-%m-%d", $d);

            $week_day = strftime("%w", $d);
            if ($week_day == 1) 
                $prep_stat_30d[$d_str]['date_holyday'] = 1;

            $prep_stat_30d[$d_str]['date_str'] = strftime("%a", $d);
            $prep_stat_30d[$d_str]['date2']    = $d * 1000;

            if (!isset($prep_stat_30d[$d_str]['clicks'])) 
                $prep_stat_30d[$d_str]['clicks'] = 0;

            if (!isset($prep_stat_30d[$d_str]['points'])) 
                $prep_stat_30d[$d_str]['points'] = 0;

            if (isset($stat_30d[$d_str]['clicks'])) 
                $prep_stat_30d[$d_str]['clicks'] += $stat_30d[$d_str]['clicks'];

            if (isset($stat_30d[$d_str ]['points'])) 
                $prep_stat_30d[$d_str]['points'] += $stat_30d[$d_str]['points'];
        }

        $this->prep_stat_30d = $prep_stat_30d;
    }


    public function executeIndex(sfWebRequest $request) {

        # Get user advertise
        $ua_c = new Criteria;
        $ua_c->add(UserAdvertisePeer::USER_ID, $this->getUser()->getAttribute('id'));
        $ua_c->addDescendingOrderByColumn(UserAdvertisePeer::ID);

        $pager = new sfPropelPager('UserAdvertise', 5);
        $pager->setCriteria( $ua_c );
        $pager->setPage( $this->getRequestParameter('page', 1) );
        $pager->init();
        $this->pager = $pager;
        
        $this->user_ads = UserAdvertisePeer::doSelect($ua_c);

        # Get advertise
        $ids = array();
        foreach ($this->user_ads as $ad) {
            array_push($ids, $ad->getAdvertiseId());
        }

        $ad_c = new Criteria;
        $ad_c->add(AdvertisePeer::ID, $ids, Criteria::IN);
        $this->ads = AdvertisePeer::doSelect($ad_c);

        $ads_list = array();
        foreach ($this->ads as $ad) {
            $ads_list[ $ad->getId() ] = $ad;
        }

        $this->ads_list = $ads_list;

        # Get rate limits
        $this->rate_limit = new AgentLastActionPeer();
        $this->rate_limit->getAllUserInfo();

        # Get statistics
        $this->_get_statistics();

    }

    public function executeCatalog(sfWebRequest $request) {

        $this->sort     = $request->getParameter('sort');
        $this->show     = $request->getParameter('show');
        $this->category = (int) $request->getParameter('category');

        if (!$this->sort) {
            $this->sort = 'created';
        }

        if (!$this->show) {
            $this->show = 'all';
        }

        # Get categories
        $cats = AdvertiseCatalogPeer::doSelect( new Criteria() ); 
        $cat_names = array();
        $top_cat = array();
        foreach ($cats as $cat) {
            $cat_names[ $cat->getId() ] = $cat->getName(); 

            if ($cat->getParentId())
                $top_cat[ $cat->getId() ]   = $cat->getParentId();
        }
        $this->cat_names = $cat_names;
        $this->top_cat = $top_cat;

        # Get advertise
        $ad_c = new Criteria;


        if ($this->show == 'all') {
            $ad_c->add(AdvertisePeer::STATUS, sfConfig::get('app_advertise_status_work'));

        } elseif ($this->show == 'category' && $this->category) {
            $this->selected_cat = AdvertiseCatalogPeer::retrieveByPk( $this->category );

            if ($this->selected_cat->getParentId()) {
                $this->general_selected_cat = AdvertiseCatalogPeer::retrieveByPk( $this->selected_cat->getParentId() );
                $ad_c->add(AdvertisePeer::CATEGORY_ID, $this->category);
            } else {
                $ac_c = new Criteria;
                $ac_c->add(AdvertiseCatalogPeer::PARENT_ID, $this->category);
                $ad_cats = AdvertiseCatalogPeer::doSelect($ac_c);

                $ids = array($this->category);

                foreach ($ad_cats as $ad_cat) {
                    array_push($ids, $ad_cat->getId());
                }

                $ad_c->add(AdvertisePeer::CATEGORY_ID, $ids, Criteria::IN);

            }

            $ad_c->add(AdvertisePeer::STATUS, sfConfig::get('app_advertise_status_work'));

            $response = $this->getResponse();
            $response->setTitle( 'AdRRIVA - Каталог рекламы: '.$this->selected_cat->getName() );


        } elseif ($this->show == 'category' && !$this->category) {

            $sub_categories = array();
            $general_categories = array();
            foreach ($cats as $cat) {
                if ($cat->getParentId()) {
                    if (!isset($sub_categories[ $cat->getParentId() ]))
                        $sub_categories[ $cat->getParentId() ] = array();

                    array_push($sub_categories[ $cat->getParentId() ], $cat);

                } else {
                    array_push($general_categories, $cat);

                }
            }

            $this->sub_categories = $sub_categories;
            $this->general_categories = $general_categories;

        }
        
        if ($this->sort == 'created') {
            $ad_c->addDescendingOrderByColumn(AdvertisePeer::ID);
       
        } elseif ($this->sort == 'cost') {
            $ad_c->addDescendingOrderByColumn(AdvertisePeer::COST);

        } elseif ($this->sort == 'popularity') {
            $ad_c->addDescendingOrderByColumn(AdvertisePeer::AGENTS);

        }

        $pager = new sfPropelPager('Advertise', 10);
        $pager->setCriteria( $ad_c );
        $pager->setPage( $this->getRequestParameter('page', 1) );
        $pager->init();
        $this->pager = $pager;
        
        # Get user advertise
        $ad_c = new Criteria;
        $ad_c->add(UserAdvertisePeer::USER_ID, $this->getUser()->getAttribute('id'));
        $user_ads = UserAdvertisePeer::doSelect($ad_c);

        $ua_ads = array();
        foreach ($user_ads as $ad) {
            $ua_ads[ $ad->getAdvertiseId() ] = 1;
        }
        $this->ua_ads = $ua_ads;

    }

    public function executeAddAdvertise(sfWebRequest $request) {
        $ad = AdvertisePeer::retrieveByPk( (int) $request->getParameter('id') );

        if ($ad) {
            $ua = new UserAdvertise();
            $ua->setUserId( $this->getUser()->getAttribute('id') );
            $ua->setAdvertId( $ad->getOwnerId() );
            $ua->setUrl( $ad->getUrl() );
            $ua->setAdvertiseId( $ad->getId() );
            $ua->setSecret( substr(md5(time() . rand() . $ad->getId() . $this->getUser()->getAttribute('id') . sfConfig::get('app_user_ad_secret') ), 0, 8) );
            $ua->setStatus( sfConfig::get('app_user_ad_status_work') );
            $ua->save();

            $ad->setAgents( $ad->getAgents() + 1 );
            $ad->save();

            return $this->renderText(json_encode( array('response' => 'ok') ));
        }

        return $this->renderText(json_encode( array('response' => 'undef') ));
    }


    public function executeDeleteAdvertise(sfWebRequest $request) {
        $ua = UserAdvertisePeer::retrieveByPk( (int) $request->getParameter('id') );

        if ($this->getUser()->getAttribute('id') == $ua->getUserId()) {
            $ad = $ua->getAdvertise();
            $ad->setAgents( $ad->getAgents() - 1 );
            $ad->save();

            $ua->delete();

            return $this->renderText(json_encode( array('response' => 'ok') ));
        }

        return $this->renderText(json_encode( array('response' => 'error') ));
    }


    public function executeShare(sfWebRequest $request) {

        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        # Get params
        $this->sn = $request->getParameter('sn');

        $this->ua = UserAdvertisePeer::retrieveByPk( (int) $request->getParameter('id') );
        $this->error = 0;

        if (!$this->ua) { 
            $this->error = 1;
            return;
        }

        # Get rate limits
        $this->rate_limit = new AgentLastActionPeer();
        $this->rate_limit->getAllUserInfo();

        # Choose social network to start advertise
        if ($this->sn) {

            # Create link 
            $this->ad     = $this->ua->getAdvertise();
            $this->a_hash = substr(md5($this->getUser()->getAttribute('id') + sfConfig::get('app_user_ad_secret') + time() + rand()), 0, 4); 

            $this->util = new Util;

            $this->go_url = $this->util->getLink(
                sfConfig::get('app_redirect_url'),
                array(
                    'ua_id'  => $this->ua->getId(),
                    'a_hash' => $this->a_hash,
                    's'      => $this->ua->getSecret(),
                )
            );

            $this->go_url_enc = urlencode($this->go_url);

            # Get params for advertise
            $this->ad_subj = $this->ad->getSubject();
            $this->ad_text = $this->ad->getText();
            $this->ad_img  = $this->ad->getThumbnailAbsPath();

            # Create action
            $action = new Action();
            $action->setHash( $this->a_hash );
            $action->setTime( time() );
            $action->setUaId( $this->ua->getId() );
            $action->setCost( $this->ad->getCost() );

            if (sfConfig::get('app_social_network_'.$this->sn) ) {
                $action->setSocialNetwork( sfConfig::get('app_social_network_'.$this->sn) );
            } else {
                $this->error = 1;
                return;
            }

            $action->save();
        }

    }

    public function executeStatistics(sfWebRequest $request) {

        $this->_get_statistics();
        $this->_get_agent_statistics();

    }

    public function executeHelp(sfWebRequest $request) {

    }

    public function executeCreateTransfer(sfWebRequest $request) {
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        if ($request->isMethod('post')) {
            $points   = $request->getParameter('points');
            $currency = $request->getParameter('currency');
            $money_id = $request->getParameter('money_id');
            $comment  = $request->getParameter('comment');

            $money = $points * sfConfig::get('app_point_ruble_course');
            $curr  = sfConfig::get('app_emoney_id_'.$currency);

            if (!$curr) {
                return $this->renderText(json_encode( array('message' => 'post_error') ));
            }

            # Check balance
            $uid = $this->getUser()->getAttribute('id');

            $ac_c = new Criteria();
            $ac_c->add(AccountPeer::USER_ID, $uid);
            $account = AccountPeer::doSelectOne($ac_c);

            if ($account->getBalance() < $points) {
                return $this->renderText(json_encode( array('error' => 'balance') ));
            }

            # Decrease user balance
            $account->setBalance( $account->getBalance() - $points );
            $account->save();

            # Create Outgoing funds
            $funds = new OutgoingFunds;
            $funds->setTime( time() );
            $funds->setAccountId( $account->getId() );
            $funds->setUserId($uid);
            $funds->setAmount($points);
            $funds->setMoney(floor($money * 100));
            $funds->setStatus( sfConfig::get('app_outgoing_funds_status_new') );
            $funds->setCurrency($curr);
            $funds->setEmoneyId($money_id);
            $funds->setComment($comment);
            $funds->save();

            return $this->renderText(json_encode( array('message' => 'ok') ));
        }

        return $this->renderText(json_encode( array('message' => 'post_error') ));
    }

    public function executeSecure() {

    }
}
