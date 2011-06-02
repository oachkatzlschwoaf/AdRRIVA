<?php

class Account extends BaseAccount {

    public function convertPointToRur() {
        return floor($this->getBalance() * sfConfig::get('app_point_ruble_course'));
    }

    public function increaseBalance($amount) {

        # Increase account balance
        $this->setBalance( $this->getBalance() + $amount );
        $this->setStatus( sfConfig::get('app_account_status_work') );
        $this->save();

        # Unblock advertise
        $a_c = new Criteria;
        $a_c->add(AdvertisePeer::OWNER_ID, $this->getUserId());
        $a_c->add(AdvertisePeer::STATUS, sfConfig::get('app_advertise_status_money_block'));
        $ads = AdvertisePeer::doSelect($a_c);

        if (isset($ads) && count($ads) > 0) {
            foreach ($ads as $ad) {
                $ad->setStatus(sfConfig::get('app_advertise_status_work'));
                $ad->save();
            }
        }

        return 1;
    }

} // Account
