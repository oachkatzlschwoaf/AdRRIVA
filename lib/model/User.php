<?php


class User extends BaseUser {

    public function setPassword($v) {

        $hex_pass = md5($v);

        $res = parent::setPassword($hex_pass);
        return $res;
    } 

} 
