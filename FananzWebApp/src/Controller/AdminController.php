<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;

/**
 * Description of AdminController
 *
 * @author anand
 */
class AdminController extends AppController {

    private $_isAdminLoggedIn = false;

    public function login() {
        $this->layout = 'home_layout';

        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            $email = $requestData['email'];
            $password = $requestData['password'];

            $isUserVerified = $this->getLoggedInAdmin($email, $password);

            if ($isUserVerified) {
                $this->redirect('/admin/dashboard');
            } else {
                $errorDivClass = 'error-wrapper error-msg-display-block';
                $errorMessage = \App\Dto\BaseResponseDto::getErrorText(238);
                $this->set(['errorDivClass' => $errorDivClass,
                    'errorMsg' => $errorMessage]);
            }
        } else {
            $errorDivClass = 'error-wrapper error-msg-display-none';
            $this->set(['errorDivClass' => $errorDivClass,
                'errorMsg' => '']);
        }
    }

    private function getLoggedInAdmin($email, $password) {
        $verifiedCredentials = false;
        $adminCredential = new \App\Dto\AdminLoginDto();
        $adminCredential->adminEmail = $email;
        $adminCredential->adminPassword = $password;

        if (ADMIN_EMAIL == $adminCredential->adminEmail &&
                ADMIN_PASSWORD == $adminCredential->adminPassword) {
            $verifiedCredentials = true;

            $this->sessionManager->saveAdminLoginInfo($adminCredential);
        }
        return $verifiedCredentials;
    }

    public function forgotPass() {
        $this->apiInitialize();
        $requestData = $this->request->data;
        $email = $requestData['emailId'];
        $emailPasswordDto = $this->getAdminInfo($email);
        if ($emailPasswordDto) {
            //$emailSuccess = false;
            try {
                $emailSuccess = \App\Utils\EmailSenderUtility::sendForgotPasswordEmail
                                ($email, $emailPasswordDto->name, $emailPasswordDto->password);
                //$this->redirect('/admin/login');
            } catch (\Exception $exc) {
                \Cake\Log\Log::error('Could not send forgot password email ' . $exc->getTraceAsString());
            }
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(121));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(223));
        }
    }

    public function getAdminInfo($emailId) {
        $emailPassword = null;

        if (ADMIN_EMAIL == $emailId) {
            $emailPassword = new \App\Dto\AdminEmailPassDto();
            $emailPassword->name = 'Admin';
            $emailPassword->password = ADMIN_PASSWORD;
        }
        return $emailPassword;
    }

    //put your code here

    public function dashboard() {
        $this->_isAdminLoggedIn = $this->sessionManager->isAdminLoggedIn();

        if (!$this->_isAdminLoggedIn) {
            $this->redirect('/admin/login');
            return;
        }
        $this->layout = 'home_layout';

        $eventCategoryTable = new \App\Model\Table\EventcategoriesTable();
        $categoryList = $eventCategoryTable->getCategories();
        $bannerTypeList = \App\Utils\BannerTypeUtil::getDefaultTypeList();

        $this->set(['categoryList' => $categoryList,
            'bannerTypeList' => $bannerTypeList,
            'isAdminLoggedIn' => true]);
    }

    public function subscriberList() {
        $currentRecordCount = 0;
        //$pageNo = 1;
        $this->apiInitialize();
        $subscriberTable = new \App\Model\Table\SubscribersTable();
        $dataTableQuery = $this->_parseDataTableQuery();
        $totalRecordCount = $subscriberTable->getTotalRecordCount();
        $subscriberList = $subscriberTable->getSubscriberList($dataTableQuery->pageSize, $dataTableQuery->startIndex);
        if (is_array($subscriberList)) {
            $currentRecordCount = count($subscriberList);
        }
        foreach ($subscriberList as $subscriberRecord) {
            if ($subscriberRecord->isSubscribed) {
                $subscriberRecord->subscriptionStatus = SUBSCRIPTION_STATUS_SUBSCRIBED;
                if ($subscriberRecord->currentStatusId == SUBSCRIPTION_STATUS_ACTIVE) {
                    $subscriberRecord->currentActionId = SUBSCRIBER_ON_HOLD;
                } else {
                    $subscriberRecord->currentActionId = SUBSCRIBER_ACTIVATE;
                }
            } else {
                $subscriberRecord->subscriptionStatus = SUBSCRIPTION_STATUS_REGISTERED;
                $subscriberRecord->currentActionId = SUBSCRIBER_BYPASS;
            }
        }
        //$encodedString = json_encode($subscriberList);

        $json_data = array(
            "draw" => intval($dataTableQuery->draw),
            "recordsTotal" => intval($totalRecordCount),
            "recordsFiltered" => intval($totalRecordCount),
            "data" => $subscriberList
        );
        $encodedString = json_encode($json_data);

        $this->response->body($encodedString);
    }

    private function _parseDataTableQuery() {
        $queryParams = $this->request->query;
        $dtParams = new \App\Dto\SubscriberDataTableQueryParams();
        $dtParams->draw = $queryParams['draw'];
        $dtParams->pageSize = $queryParams['length'];
        $requestedPage = $queryParams['start'] / $queryParams['length'];
        $dtParams->startIndex = $requestedPage + 1;
        return $dtParams;
    }

}
