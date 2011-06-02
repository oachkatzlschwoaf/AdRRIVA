<?php

class Util {

    public function calcSignature($request, $is_secure = null, $vid = null) {
        $sig_str = '';
        
        if (!$is_secure)
            $sig_str = $vid;

        ksort($request);
        foreach ($request as $param => $val) {
            if ($param == 'sig') { 
                continue;
            }
            
            $sig_str .= $param.'='.$val;
        }

        if ($is_secure)
            $sig_str .= sfConfig::get('app_secret_key');
        else
            $sig_str .= sfConfig::get('app_private_key');

        return md5($sig_str);
    }

    public function saveImage($files, $image, $image_field, $dir, $image_name, $options = array()) {

        # Thumbnail
        if (count($options) > 0) {
            foreach ($options as $thm => $thm_opt) {
                
                $prefix = 'thm';
                if (isset($thm_opt['prefix']))
                    $prefix = $thm_opt['prefix'];
            
                $image_thm = new sfThumbnail($thm_opt['width'], $thm_opt['height'], false, true, 95, 'sfImageMagickAdapter', array('method' => 'shave_all'));
                $image_thm->loadFile($files[$image_field]['tmp_name']);
                $image_thm->save(sfConfig::get('sf_upload_dir').'/'.$dir.'/'.$prefix.'_'.$image_name.'_'.$thm.'.jpg');

            }
        }

        # Original image 
        $image_path = sfConfig::get('sf_upload_dir').'/'.$dir.'/'.$image_name.'.jpg';
        $image->save($image_path);
        
        return $image_path;
    }

    public function getLink ($url, $params=array(), $use_existing_arguments=false) {
        if($use_existing_arguments) $params = $params + $_GET;
        if(!$params) return $url;

        $link = $url;

        if(strpos($link,'?') === false) $link .= '?'; //If there is no '?' add one at the end
        elseif(!preg_match('/(\?|\&(amp;)?)$/',$link)) $link .= '&'; //If there is no '&' at the END, add one.

        $params_arr = array();
        foreach($params as $key=>$value) {
            if(gettype($value) == 'array') { //Handle array data properly
                foreach($value as $val) {
                    $params_arr[] = $key . '[]=' . urlencode($val);
                }
            } else {
                $params_arr[] = $key . '=' . urlencode($value);
            }
        }
        $link .= implode('&',$params_arr);

        return $link;
    } 

    public function declension($int, $expressions, $showint = true) {

        $count = $int % 100;
        if ($count >= 5 && $count <= 20) {
            $result = ($showint? $int." ":"").$expressions['2'];
        } else {
            $count = $count % 10;
            if ($count == 1) {
                $result = ($showint? $int." ":"").$expressions['0'];
            } elseif ($count >= 2 && $count <= 4) {
                $result = ($showint? $int." ":"").$expressions['1'];
            } else {
                $result = ($showint? $int." ":"").$expressions['2'];
            }
        }

        return $result;
    } 

    private function _return_last_action_limit($last_action) {
        if ((time() - $last_action) < sfconfig::get('app_rate_limit_stream')) {
            
                $diff = $last_action + sfconfig::get('app_rate_limit_stream') - time();
                $grl_hours = floor( $diff / (60 * 60) ); 
                $grl_min = floor(($diff - $grl_hours * 60 * 60) / 60) + 1; 

                return ($grl_hours > 0 ? $this->declension($grl_hours, array('час', 'часа', 'часов'), 1) : "")
                    ." ".$this->declension($grl_min, array("минуту", "минуты", "минут"), 1);

        } else {
            return;
        }
    }

    public function checkRateLimit($last_action, $ua = null) {

        if (!sfConfig::get('app_rate_limit_check'))
            return;

        if ($ua && $ua->getLastAction()) {

            if ((time() - $ua->getLastAction()) < sfconfig::get('app_rate_limit_ua')) {

                    $diff = $ua->getLastAction() + sfconfig::get('app_rate_limit_ua') - time();
                    $grl_hours = floor( $diff / (60 * 60) ); 
                    $grl_min = floor(($diff - $grl_hours * 60 * 60) / 60) + 1; 

                    return ($grl_hours > 0 ? $this->declension($grl_hours, array('час', 'часа', 'часов'), 1) : "")
                        ." ".$this->declension($grl_min, array("минуту", "минуты", "минут"), 1);

            } else {
                return $this->_return_last_action_limit($last_action);
            }

        } elseif ($last_action) {
            return $this->_return_last_action_limit($last_action);

        } else {
            return;
        }

    }


}
