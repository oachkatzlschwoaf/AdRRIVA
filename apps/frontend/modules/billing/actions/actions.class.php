<?php

class billingActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $money = $request->getParameter('OutSum');
        $id    = $request->getParameter('InvId');
        $sig   = $request->getParameter('SignatureValue');

        # Check signature
        $sig_str = implode(':', array($money, $id, sfConfig::get('app_robox_pass2')));  

        if (strtolower($sig) != strtolower( md5($sig_str) )) {
            return $this->renderText('ERROR');
        }

        # Lookup funds
        $funds = IncomingFundsPeer::retrieveByPk( $id );

        if (!$funds || !$funds->getId()) {
            return $this->renderText('ERROR');
        }

        # Repeat check
        if ($funds->getMoney() > 0) {
            return $this->renderText('ERROR');
        }

        # Save incoming funds
        $funds->setMoney($money);
        $funds->setStatus( sfConfig::get('app_incoming_funds_status_done') );
        $funds->save();

        # Increase account balance
        $points = floor($money / sfConfig::get('app_point_ruble_course'));

        $account = AccountPeer::retrieveByPk( $funds->getToAccount() );
        $account->increaseBalance($points);

        return $this->renderText('OK'.$id);
    }

    public function executeGetRequest(sfWebRequest $request) {

        $points = (int) $request->getParameter('points');
        $amount = (int) $request->getParameter('amount');
        $uid = $this->getUser()->getAttribute('id');

        # Lookup user
        if (!$uid) 
            return $this->renderText(json_encode( array('fail' => 'uid') ));

        $user = UserPeer::retrieveByPk($uid);

        if (!$user || !$user->getId()) 
            return $this->renderText(json_encode( array('fail' => 'user') ));

        # Lookup account
        $account = $user->getAccounts();
        $account = $account[0];
        $to_account = $account->getId();

        # Create new incoming funds
        $funds = new IncomingFunds;
        $funds->setToAccount($to_account);
        $funds->setAmount($amount);
        $funds->setStatus( sfConfig::get('app_incoming_funds_status_new') );
        $funds->save();

        # Calc sig
        $this->util = new Util;
        $req = array(
            'MrchLogin'  => sfConfig::get('app_robox_login'),
            'OutSum'     => ($amount / 100),
            'InvId'      => $funds->getId(),
        );

        $sig_str = implode(':', array($req['MrchLogin'], $req['OutSum'], $req['InvId'], sfConfig::get('app_robox_pass1')));  

        $req['SignatureValue'] = md5($sig_str); 

        $robox_url = $this->util->getLink(
            sfConfig::get('app_robox_url'),
            $req
        );

        return $this->renderText(json_encode( array('url' => $robox_url) ));
    }
}
