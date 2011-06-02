<?php

class Advertise extends BaseAdvertise {

    public function getThumbnailImage() {

        $thm_height = sfConfig::get('app_ad_images_size_share_height');
        $thm_width  = sfConfig::get('app_ad_images_size_share_width');

        if (is_file(sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_ad_images_dir_share').'/thm_'.$this->getId().'_'.$thm_height.'x'.$thm_width.'.jpg')) {
            return image_tag('../uploads/'.sfConfig::get('app_ad_images_dir_share').'/thm_'.$this->getId().'_'.$thm_height.'x'.$thm_width.'.jpg');
        }

        return;
    }

    public function getThumbnailPath() {
        $thm_height = sfConfig::get('app_ad_images_size_share_height');
        $thm_width  = sfConfig::get('app_ad_images_size_share_width');

        return '../uploads/'.sfConfig::get('app_ad_images_dir_share').'/thm_'.$this->getId().'_'.$thm_height.'x'.$thm_width.'.jpg';
    }

    public function getThumbnailAbsPath() {
        $thm_height = sfConfig::get('app_ad_images_size_share_height');
        $thm_width  = sfConfig::get('app_ad_images_size_share_width');

        return sfConfig::get('app_thumbnail_path').sfConfig::get('app_ad_images_dir_share').'/thm_'.$this->getId().'_'.$thm_height.'x'.$thm_width.'.jpg';
    }

    public function setStatus($v) {
        $user = $this->getUser();
        $accs = $user->getAccounts();

        $account = $accs[0];

        # TODO: if user banned - use banned status

        if ($account->getBalance() <= 0) {
            $v = sfConfig::get('app_advertise_status_money_block');

        } elseif ($v == sfConfig::get('app_advertise_status_advert_block')) {

            # Block user advertise
            $u_ads = $this->getUserAdvertises();

            foreach ($u_ads as $u_a) {
                $u_a->setStatus(sfConfig::get('app_user_ad_status_advert_block'));
                $u_a->save();
            }

        } elseif ($v == sfConfig::get('app_advertise_status_work')) {

            # Unblock user advertise
            $u_ads = $this->getUserAdvertises();

            foreach ($u_ads as $u_a) {
                $u_a->setStatus(sfConfig::get('app_user_ad_status_work'));
                $u_a->save();
            }

        }

        $res = parent::setStatus($v);
        return $res;
    }

    public function delete(PropelPDO $con = null) {

        $u_ads = $this->getUserAdvertises();

        foreach ($u_ads as $u_a) { 
            $memcache = new Memcache;
            $memcache->connect('localhost', 11211) or die ("Could not connect");
            $memcache->delete("ua_".$u_a->getId());

            $u_a->delete();
        }

        $res = parent::delete($con);
        return $res;
    }

} // Advertise
