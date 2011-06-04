<?php

class defaultActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

    }

    public function executeHelp(sfWebRequest $request) {

    }

    public function executeAdvertHelp(sfWebRequest $request) {

    }

    public function executeAgentHelp(sfWebRequest $request) {

    }

    public function executeRegisterAdvert(sfWebRequest $request) {

        if ($request->isMethod('post')) {

            $this->email        = $request->getParameter('email');
            $this->password     = $request->getParameter('password');
            $this->password_ret = $request->getParameter('password_ret');

            $this->setLayout(false);
            sfConfig::set('sf_web_debug', false);

            # Check form 
            $this->getResponse()->setContentType('text/json');
            
            # Register user;
            $res = $this->_register_user(sfConfig::get('app_user_role_advert'), $request);

            if ($res == 2) {
                return $this->renderText(json_encode( array('message' => 'already_exists', 'email' => $this->email) ));

            } elseif ($res == 1) {
                return $this->renderText(json_encode( array('message' => 'success') ));

            } else {
                return $this->renderText(json_encode( array('message' => 'error') ));
            }
        }

    }

    public function executeRegisterAgent(sfWebRequest $request) {

        if ($request->isMethod('post')) {

            $this->email        = $request->getParameter('email');
            $this->password     = $request->getParameter('password');
            $this->password_ret = $request->getParameter('password_ret');

            $this->setLayout(false);
            sfConfig::set('sf_web_debug', false);

            # Check form 
            $this->getResponse()->setContentType('text/json');
            
            # Register user;
            $res = $this->_register_user(sfConfig::get('app_user_role_agent'), $request);

            if ($res == 2) {
                return $this->renderText(json_encode( array('message' => 'already_exists', 'email' => $this->email) ));

            } elseif ($res == 1) {
                return $this->renderText(json_encode( array('message' => 'success') ));

            } else {
                return $this->renderText(json_encode( array('message' => 'error') ));
            }
        }

    }

    public function executeActivateAccount(sfWebRequest $request) {
        $code = $request->getParameter('code');

        $activ = UserActivatePeer::retrieveByPk($code);

        if (!$activ) {
            $this->error = 'not_found';
        } else {
            $activ->delete();
        }

    }

    public function _register_user($role, sfWebRequest $request) {

        $u_c = new Criteria;
        $u_c->add(UserPeer::EMAIL, $this->email);
        $user = UserPeer::doSelectOne($u_c);

        if ($user) {
            return 2;
        }

        # Register user
        $user = new User;
        $user->setRole($role);
        $user->setEmail( $this->email );
        $user->setPassword( $this->password );
        $user->setIpRegister( sprintf("%u", ip2long( $request->getRemoteAddress() )) );
        $user->setIpLast( sprintf("%u", ip2long( $request->getRemoteAddress() )) );
        $user->setVisitAt( time() );
        $user->save();

        if (!$user->getId()) {
            return 3;
        }

        # Create new account for user
        $account = new Account();
        $account->setStatus( sfConfig::get('app_account_status_work') );
        $account->setUserId( $user->getId() );
        $account->save();

        $activate = new UserActivate;
        $activate->setUserId( $user->getId() );
        $activate->setCode( md5( mt_rand(0, 1000000) . $this->email . time() ) );
        $activate->save();

        sfProjectConfiguration::getActive()->loadHelpers('Url'); 

        # Send message
        $message = $this->getMailer()->composeAndSend(
            'advert_support@adrriva.ru',
            $this->email,
            'Ваш код подтверждения аккаунта',
            'Спасибо за регистрацию в AdRRIVA!
        
Для активации вашего аккаунта перейдите по ссылке: 
'.url_for('default/activateAccount?code='.$activate->getCode(), true).'

Если вы не регистрировались в системе AdRRIVA - просто не обращайте внимания на это письмо.

С уважением,
Команда поддержки AdRRIVA
---
http://www.adrriva.ru'
        );

        return 1;
    }

    public function executeLogin(sfWebRequest $request) {

        if ($request->isMethod('post')) {
                 
            $this->email        = $request->getParameter('login_email');
            $this->password     = $request->getParameter('login_password');

            $u_c = new Criteria;
            $u_c->add(UserPeer::EMAIL, $this->email);
            $user = UserPeer::doSelectOne($u_c);

            if (!$user) {
                return $this->renderText(json_encode( array('message' => 'unknown_user') ));
            }

            if (md5($this->password) != $user->getPassword()) {
                return $this->renderText(json_encode( array('message' => 'invalid_password') ));
            }

            $this->getUser()->setAuthenticated(true);
            $this->getUser()->setAttribute('role', $user->getRole());
            $this->getUser()->setAttribute('email', $user->getEmail());
            $this->getUser()->setAttribute('id', $user->getId());
            $this->getUser()->addCredential('role_'.$user->getRole());

            return $this->renderText(json_encode( array('message' => 'success', 'role' => $user->getRole()) ));

        }

    }

    public function executeLogout(sfWebRequest $request) {
        $this->getUser()->setAuthenticated(false);
        $this->redirect('default/index');

    }

    public function executeRememberPassword(sfWebRequest $request) {
        if ($request->isMethod('post')) {
                 
            $this->email        = $request->getParameter('login_email');

            $u_c = new Criteria;
            $u_c->add(UserPeer::EMAIL, $this->email);
            $user = UserPeer::doSelectOne($u_c);

            if (!$user) {
                return $this->renderText(json_encode( array('message' => 'error') ));
            }

            $new_pass = md5(mt_rand(0, 1000000) . $user->getId() . time());
            $new_pass = substr($new_pass, 0, 6);

            $user->setPassword( $new_pass ); 
            $user->save();

            # Send message
            $message = $this->getMailer()->composeAndSend(
                'advert_support@adrriva.ru',
                $this->email,
                'Ваш новый пароль',
                'Добрый день!
        
Ваш пароль в системе AdRRIVA был изменен, по запросу восстановления пароля.

Ваш новый пароль: '.$new_pass.'


С уважением,
Команда поддержки AdRRIVA
---
http://www.adrriva.ru'
            );

            return $this->renderText(json_encode( array('message' => 'success', 'pass' => $new_pass) ));

        }
    }

    public function executeShowAdvertise(sfWebRequest $request) {
        $response = $this->getResponse();

        $ua_id = $request->getParameter('ua_id'); 

        $ua = UserAdvertisePeer::retrieveByPk($ua_id);
        $this->ad = $ua->getAdvertise();
        
        $response->setTitle($this->ad->getSubject());
        $response->addMeta('description', $this->ad->getText());
    }

    public function executeFeedback(sfWebRequest $request) {

    }

    public function executeShowError(sfWebRequest $request) {

    }

    public function executeError404() {

    }

    public function executeSecure() {

    }
}
