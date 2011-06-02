<?php

class advertActions extends sfActions {

    private function _get_statistics() {

        # Get statistic
        $ac_c = new Criteria();
        $ac_c->add(AccountPeer::USER_ID, $this->getUser()->getAttribute('id'));
        $this->account = AccountPeer::doSelectOne($ac_c);

        $ac_c = new Criteria();
        $ac_c->add(StatAdvertDailyPeer::ADVERT_ID, $this->getUser()->getAttribute('id'));
        $ac_c->add(StatAdvertDailyPeer::DATE, time());
        $this->ad_stats = StatAdvertDailyPeer::doSelect($ac_c);

        $seg_ad_stats = array();
        $this->total_clicks = 0;
        $this->total_points = 0;

        foreach ($this->ad_stats as $stat) {
            $seg_ad_stats[ $stat->getAdId() ] = $stat;

            $this->total_clicks += $stat->getClicks();
            $this->total_points += $stat->getPoints();
        }

        $this->seg_ad_stats = $seg_ad_stats;

    }


    private function _get_advert_statistics() {
        
        $days_interval = 30;

        # Get statistic
        $ac_c = new Criteria();
        $ac_c->add(AccountPeer::USER_ID, $this->getUser()->getAttribute('id'));
        $this->account = AccountPeer::doSelectOne($ac_c);

        $ac_c = new Criteria();
        $ac_c->add(StatAdvertDailyPeer::ADVERT_ID, $this->getUser()->getAttribute('id'));
        $ac_c->add(StatAdvertDailyPeer::DATE, (time() - $days_interval * 24 * 60 * 60), Criteria::GREATER_THAN);
        $this->advert_stats = StatAdvertDailyPeer::doSelect($ac_c);

        $stat_30d = array();
    
        foreach ($this->advert_stats as $stat) {
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

        $this->advertise_form = new AdvertiseForm();

        # Get advertise (my advertise)
        $ad_c = new Criteria();
        $ad_c->addDescendingOrderByColumn(AdvertisePeer::ID);
        $ad_c->add(AdvertisePeer::OWNER_ID, $this->getUser()->getAttribute('id'));

        # Get categories
        $cat_c = new Criteria;
        $cat_c->addAscendingOrderByColumn(AdvertiseCatalogPeer::ORDER_ID);
        $this->cats = AdvertiseCatalogPeer::doSelect($cat_c); 

        $pager = new sfPropelPager('Advertise', 10);
        $pager->setCriteria( $ad_c );
        $pager->setPage( $this->getRequestParameter('page', 1) );
        $pager->init();
        $this->pager = $pager;

        $this->_get_statistics();

    }


    public function executeChangeAdvertise(sfWebRequest $request) {

        $adv = $request->getParameter("advertise");

        if (!isset($adv["id"]) || !$adv["id"]) {
            $this->form = new AdvertiseForm();
        } else {
            $ad = AdvertisePeer::retrieveByPk( $adv['id'] );
            
            if (!$ad || $ad->getOwnerId() != $this->getUser()->getAttribute('id')) {
                return $this->renderText(json_encode( array('message' => 'post_error') ));
            }

            $this->form = new AdvertiseForm($ad);
        }

        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);

        if ($request->isMethod('POST')) {
            $this->form->bind($request->getParameter('advertise'), $files = $request->getFiles('advertise'));

            if ($this->form->isValid()) {
                # Set advertise params
                if ($this->form->isNew()) {

                    # Set status: if account > 0 - new, else: block
                    $this->form->getObject()->setOwnerId($this->getUser()->getAttribute('id'));
                    $this->form->getObject()->setStatus(sfConfig::get('app_advertise_status_work'));
                    $this->form->getObject()->setType(sfConfig::get('app_advertise_type_share'));
                }

                # Save advertise info 
                $this->form->save();

                # Save image
                if ($image = $this->form->getValue('image')) {
                    $util = new Util;

                    $thm_height = sfConfig::get('app_ad_images_size_share_height');
                    $thm_width  = sfConfig::get('app_ad_images_size_share_width');

                    $util->saveImage($files, $image, 'image', sfConfig::get('app_ad_images_dir_share'), $this->form->getObject()->getId(),
                        array(
                            $thm_height.'x'.$thm_width => array(
                                'width'  => $thm_width,
                                'height' => $thm_height,
                            )
                        )
                    );
                }

                return $this->renderText(json_encode( array('message' => 'ok') ));

            } else {

                # DEBUG
                foreach( $this->form->getFormFieldSchema( ) as $name => $formField ) {
                   if( $formField->getError( ) != "" ) {
                        error_log( $name . " : " . $formField->getError( ) . "\n" );
                   }
                }

                return $this->renderText(json_encode( array('message' => 'validate_error') ));
            }
        }

        return $this->renderText(json_encode( array('message' => 'post_error') ));

    }


    public function executeGetAdvertise(sfWebRequest $request) {
        $ad = AdvertisePeer::retrieveByPk( (int) $request->getParameter('id') );

        if ($ad) {
            $form = new AdvertiseForm($ad);

            if ($ad->getOwnerId() == $this->getUser()->getAttribute('id')) {
                $ad_info = array(
                    'id'          => $ad->getId(),
                    'subject'     => $ad->getSubject(),
                    'text'        => $ad->getText(),
                    'url'         => $ad->getUrl(),
                    'cost'        => $ad->getCost(),
                    'category_id' => $ad->getCategoryId(),
                    'thumb'       => $ad->getThumbnailPath(),
                    'token'       => $form->getCSRFToken()
                );

                return $this->renderText(json_encode( array('response' => $ad_info) ));
            }

            return $this->renderText(json_encode( array('response' => 'undef') ));

        } else {
            return $this->renderText(json_encode( array('response' => 'undef') ));
        }
    }


    public function executeDeleteAdvertise(sfWebRequest $request) {
        $ad = AdvertisePeer::retrieveByPk( (int) $request->getParameter('id') );

        if ($ad && $ad->getOwnerId() == $this->getUser()->getAttribute('id')) {
            $ad->delete();
        }
        
        $this->redirect('advert/index');
    }


    public function executeBlockAdvertise(sfWebRequest $request) {
        $ad = AdvertisePeer::retrieveByPk( (int) $request->getParameter('id') );

        # Block advertise
        if ($ad && $ad->getOwnerId() == $this->getUser()->getAttribute('id')) {
            if ($ad->getStatus() == sfConfig::get('app_advertise_status_advert_block')) {
                $ad->setStatus(sfConfig::get('app_advertise_status_work')); 
            } elseif ($ad->getStatus() == sfConfig::get('app_advertise_status_work')) {
                $ad->setStatus(sfConfig::get('app_advertise_status_advert_block')); 
            }

            $ad->save();
        }

        $this->redirect('advert/index');
    }

    public function executeStatistics(sfWebRequest $request) {

        $this->_get_statistics();
        $this->_get_advert_statistics();

    }

    public function executeHelp(sfWebRequest $request) {

    }

    public function executeIncreaseBalance(sfWebRequest $request) {
        # FOR DEBUG ONLY!!!

        $user = UserPeer::retrieveByPk( $this->getUser()->getAttribute('id') );

        $account = $user->getAccounts();
        $account = $account[0];

        $account->increaseBalance(100);
    
        $this->forward('default', 'index');
    }

}
