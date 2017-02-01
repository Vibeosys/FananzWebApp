<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

/**
 * Description of SessionManagerUtil
 * @property \Cake\Network\Session $_session
 * @author anand
 */
class SessionManagerUtil {

    private $_session;

    public function __construct($session) {
        $this->_session = $session;
    }

    public function isUserLoggedIn() {
        $verifyUserLogin = $this->_session->check('User.Name') && $this->_session->check('User.Id');
        return $verifyUserLogin;
    }

    public function isSubscriberLoggedIn() {
        $verifySubscriberLogin = $this->_session->check('Subscriber.Name') && $this->_session->check('Subscriber.Id');
        return $verifySubscriberLogin;
    }

    public function isSubscriberSubscribed() {
        $isSubscribed = $this->_session->read('Subscriber.IsSubscribed');
        return $isSubscribed;
    }

    public function logout() {
        $this->_session->destroy();
    }

    public function saveUserLoginInfo($userId, $userName) {
        $this->_session->write('User.Name', $userName);
        $this->_session->write('User.Id', $userId);
    }

    /**
     * Saves subscriber info after login
     * @param \App\Dto\SubscriberDetailedInfo $subcriberDetails
     */
    public function saveSubscriberLoginInfo($subcriberDetails) {
        $this->_session->write('Subscriber.Name', $subcriberDetails->name);
        $this->_session->write('Subscriber.Id', $subcriberDetails->subscriberId);
        $subscriberType = $subcriberDetails->sType == 'f' ? FREELANCE_SUB_TYPE : CORPORATE_SUB_TYPE;
        
        $this->_session->write('Subscriber.Type', $subscriberType);
        $this->_session->write('Subscriber.IsSubscribed', $subcriberDetails->isSubscribed);
        //$this->_session->write('Subscriber.Email', $subcriberDetails->emailId);
    }

    public function getSubscriberType() {
        $subType = $this->_session->read('Subscriber.Type');
        return $subType;
    }

    public function getSubscriberId() {
        $subscriberId = $this->_session->read('Subscriber.Id');
        return $subscriberId;
    }

    public function changeSubscriberStatus() {
        $this->_session->write('Subscriber.IsSubscribed', true);
    }

    public function getSubscriberEmail() {
        return $this->_session->read('Subscriber.Email');
    }

}
