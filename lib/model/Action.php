<?php

class Action extends BaseAction {

    public function save(PropelPDO $con = null) {

        # Update last action for user
        $user = sfContext::getInstance()->getUser();

        $uid = $user->getAttribute('id');
        $user = UserPeer::retrieveByPk( $uid );
        $user->setLastAction(time());
        $user->save();

        # Update last action for rate limit
        $rl_c = new Criteria();
        $rl_c->add(AgentLastActionPeer::USER_ID, $uid);
        $rl_c->add(AgentLastActionPeer::UA_ID, $this->getUaId());
        $rl_c->add(AgentLastActionPeer::SOCIAL_NETWORK, $this->getSocialNetwork());

        $rl = AgentLastActionPeer::doSelectOne( $rl_c );

        if ($rl) {
            # Update last action time

            $rl->setActionTime( time() );
            $rl->save();

        } else {
            # Create new last action time
            $rl = new AgentLastAction();
            $rl->setUserId($uid);
            $rl->setUaId( $this->getUaId() );
            $rl->setSocialNetwork( $this->getSocialNetwork() );
            $rl->setActionTime( time() );
            $rl->save();

        }

        $res = parent::save($con);
        return $res;

    }

} // Action
