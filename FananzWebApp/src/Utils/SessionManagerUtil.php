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
        $isUserAuthenticated = false;
        $userName = $this->_session->read('User.Name');
        $userId = $this->_session->read('User.Id');
        if ($userId != '' && $userName != '') {
            $isUserAuthenticated = true;
        }
        return $isUserAuthenticated;
    }

    public function getUserName() {
        return $this->_session->read('User.Name');
    }

    public function getUserId() {
        return $this->_session->read('User.Id');
    }

    public function isSubscriberLoggedIn() {
        $subscriberName = $this->_session->read('Subscriber.Name');
        $subscriberId = $this->_session->read('Subscriber.Id');

        if ($subscriberName != '' && $subscriberId != '') {
            return true;
        } else {
            return false;
        }
    }

    public function getSubscriberName() {
        return $this->_session->read('Subscriber.Name');
    }

    public function isSubscriberSubscribed() {
        $isSubscribed = $this->_session->read('Subscriber.IsSubscribed');
        return $isSubscribed;
    }

    /**
     * Stores the admin credentials to session
     * @param \App\Dto\AdminLoginDto $adminCredential
     */
    public function saveAdminLoginInfo($adminCredential) {
        $this->_session->write('Admin.EmailId', $adminCredential->adminEmail);
        $this->_session->write('Admin.Password', $adminCredential->adminPassword);
    }

    public function isAdminLoggedIn() {
        $adminEmail = $this->_session->read('Admin.EmailId');
        $adminPassword = $this->_session->read('Admin.Password');

        if ($adminEmail != '' && $adminPassword != '') {
            return true;
        } else {
            return false;
        }
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
