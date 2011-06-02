<?php

class paymentsActions extends sfActions {

    public function preExecute() {
        $out_c = new Criteria;
        $out_c->add(OutgoingFundsPeer::TIME, time() - 60 * 60 * 24 * 30, Criteria::GREATER_THAN);
        $pre = OutgoingFundsPeer::doSelect($out_c);

        $f = array();
        foreach ($pre as $p) {
            if (!isset($f[ $p->getStatus() ]))
                $f[ $p->getStatus() ] = 0;

            $f[ $p->getStatus() ]++;
        }

        $this->cats_count = $f;
        
    }

    public function executeIndex(sfWebRequest $request) {
        $out_c = new Criteria;
        $out_c->add(OutgoingFundsPeer::STATUS, sfConfig::get('app_outgoing_funds_status_new'));
        $this->funds = OutgoingFundsPeer::doSelect($out_c);
    }

    public function executeWork(sfWebRequest $request) {
        $out_c = new Criteria;
        $out_c->add(OutgoingFundsPeer::STATUS, sfConfig::get('app_outgoing_funds_status_approved'));
        $this->funds = OutgoingFundsPeer::doSelect($out_c);
    }

    public function executePay(sfWebRequest $request) {
        $out_c = new Criteria;
        $out_c->add(OutgoingFundsPeer::STATUS, sfConfig::get('app_outgoing_funds_status_approved'));
        $this->funds = OutgoingFundsPeer::doSelect($out_c);
    }

    public function executePayed(sfWebRequest $request) {
        $out_c = new Criteria;
        $out_c->add(OutgoingFundsPeer::STATUS, sfConfig::get('app_outgoing_funds_status_done'));
        $this->funds = OutgoingFundsPeer::doSelect($out_c);
    }

    public function executeFail(sfWebRequest $request) {
        $out_c = new Criteria;
        $out_c->add(OutgoingFundsPeer::STATUS, sfConfig::get('app_outgoing_funds_status_fail'));
        $this->funds = OutgoingFundsPeer::doSelect($out_c);
    }

    public function executeApprove(sfWebRequest $request) {
        $id = $request->getParameter("id");

        $fund = OutgoingFundsPeer::retrieveByPk($id);
        $fund->setApprovedAt( time() );
        $fund->setStatus(sfConfig::get('app_outgoing_funds_status_approved'));
        $fund->save();

        // TODO: Send email to user
        
        $this->redirect('payments/index');
    }
    
    public function executeDenied(sfWebRequest $request) {
        $id = $request->getParameter("id");

        $fund = OutgoingFundsPeer::retrieveByPk($id);
        $fund->setStatus(sfConfig::get('app_outgoing_funds_status_fail'));
        $fund->save();

        // TODO: Send email to user

        $this->redirect('payments/index');
    }
}
