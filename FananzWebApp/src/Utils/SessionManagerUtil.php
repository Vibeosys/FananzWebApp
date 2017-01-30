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

    public function logout() {
        $this->_session->destroy();
    }

    public function saveUserLoginInfo($userId, $userName) {
        $this->_session->write('User.Name', $userName);
        $this->_session->write('User.Id', $userId);
    }

    public function saveSubscriberLoginInfo($subscriberId, $subscriberName, $subscriberType) {
        $this->_session->write('Subscriber.Name', $subscriberName);
        $this->_session->write('Subscriber.Id', $subscriberId);
        $this->_session->write('Subscriber.Type', $subscriberType);
    }

}
