<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;

//use App\Model\Table;

/**
 * Description of HomeController
 *
 * @author jyotima
 */
class HomePageController extends AppController {

    //put your code here


    public function index() {
        $this->layout = 'home_layout';

        $eventCategoriesTable = new \App\Model\Table\EventcategoriesTable();
        $eventCategoryList = $eventCategoriesTable->getCategoriesAndSubcategories();

        $portfolioTable = new \App\Model\Table\PortfolioTable();
        $portfoioList = $portfolioTable->getSelectedPortfolioList();

        if ($this->sessionManager->isUserLoggedIn()) {
            $this->set('isUserLoggedIn', true);
            $this->set('userName', $this->sessionManager->getUserName());
        }

        $this->set(['eventCategoryList' => $eventCategoryList]);
        $this->set(['portfoioList' => $portfoioList]);
    }

    //Ajax call
    public function specialRequest() {
        $this->apiInitialize();
        $name = $this->request->data['name'];
        $email = $this->request->data['email'];
        $mobNo = $this->request->data['mobNo'];
        $yourRequest = $this->request->data['yourRequest'];

        $contactUs = $this->_buildContactInfo($name, $email, $mobNo, $yourRequest);

        if ($contactUs) {

            try {
                $emailSuccess = \App\Utils\EmailSenderUtility::sendContactUsEmail($contactUs);
            } catch (\Exception $exc) {
                \Cake\Log\Log::error('Could not send Special Request email ' . $exc->getTraceAsString());
            }
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(121));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(223));
        }
    }

    private function _buildContactInfo($name, $email, $mobNo, $yourRequest) {
        // $contactUs = null;
        $contactUs = new \App\Dto\ContactUsRequestDto();
        $contactUs->name = $name;
        $contactUs->emailId = $email;
        $contactUs->phone = $mobNo;
        $contactUs->message = $yourRequest;

        return $contactUs;
    }

    public function sendPortfolioRequest() {
        $this->apiInitialize();
        $requestData = $this->request->data;
        $portfolioId = $requestData['portfolioId'];
        $portfolioMag = $requestData['portfolioMag'];
        $isUserLoggedIn = $this->sessionManager->isUserLoggedIn();

        if (!$isUserLoggedIn) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(239));
            return;
        }

        $portfolioTable = new \App\Model\Table\PortfolioTable();
        $portfolioInfo = $portfolioTable->getPortfolioDetailsById($portfolioId);

        //  $isUserId = $this->sessionManager->getUserId();
        $usersTable = new \App\Model\Table\UsersTable();
        $userInfoReceived = $usersTable->getRequestedUserInfoById($this->sessionManager->getUserId());

        $emailSuccess = false;

        try {
            \App\Utils\EmailSenderUtility::sendPortfolioRequestOnEmail(
                    $portfolioInfo, $userInfoReceived, $portfolioMag);
            $emailSuccess = true;
        } catch (\Exception $ex) {
            \Cake\Log\Log::error('Error while sending email ' . $ex->getTraceAsString());
        }

        $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(122));
    }

    public function logout() {
        $this->sessionManager->logout();
        $this->redirect('/');
    }

    public function policies() {
        $this->layout =false;     
    }

}
