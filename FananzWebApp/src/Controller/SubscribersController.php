<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Subscribers Controller
 *
 * @property \App\Model\Table\SubscribersTable $Subscribers
 */
class SubscribersController extends AppController {

    //Web method
    public function login($errorCode = null) {
        $this->layout = 'home_layout';

        //Error message display logic
        $errorMessage = null;
        if ($errorCode != null) {
            $errorMessage = \App\Dto\BaseResponseDto::getErrorText($errorCode);
            $this->set('errorDivClass', 'error-wrapper error-msg-display-block');
        } else {
            $this->set('errorDivClass', 'error-wrapper error-msg-display-none');
        }

        $this->set('errorMsg', $errorMessage);
    }

    //Web method
    public function checkLogin() {
        $subscriberUserDto = new \App\Dto\SubscriberUserDto();
        $subscriberUserDto->emailId = $this->request->data['name'];
        $subscriberUserDto->password = $this->request->data['password'];
        $subscriberDetails = $this->Subscribers->signIn($subscriberUserDto);

        //Save to session
        $this->sessionManager->saveSubscriberLoginInfo($subscriberDetails);

        if ($subscriberDetails) {
            $isSubscribed = $this->sessionManager->isSubscriberSubscribed();
            if ($isSubscribed) {//Add details to session manager
                $this->redirect('/subscribers/portfolio');
            } else {
                $this->redirect('/subscribers/paysubscription');
            }
        } else {
            $this->setAction('login', 204);
        }
    }

    public function registerFreelance() {
        $subscriberDetails = $this->_buildFreelanceRegistration($this->request->data);
        $isDuplicateSubcriber = $this->Subscribers->isSubscriberExists($subscriberDetails->emailId);
        if ($isDuplicateSubcriber) {
            //Throw error
            $this->setAction('signup', 222, FREELANCE_SUB_TYPE);
            return;
        }

        $subscriberId = $this->Subscribers->registerSubscriber($subscriberDetails);
        if ($subscriberId) {
            //Send welcome email
            try {
                $subscriberPayLaterDetails = $this->Subscribers->getSubscriberDetails($subscriberId);
                \App\Utils\EmailSenderUtility::sendWelcomeEmail($subscriberPayLaterDetails);
            } catch (\Exception $ex) {
                \Cake\Log\Log::error('Error while sending welcome email ' . $ex->getTraceAsString());
            }
            //Build session data to store data
            $subscriberDetailInfo = new \App\Dto\SubscriberDetailedInfo();
            $subscriberDetailInfo->name = $subscriberDetails->name;
            $subscriberDetailInfo->emailId = $subscriberDetails->emailId;
            $subscriberDetailInfo->sType = $subscriberDetails->subScrType;
            $subscriberDetailInfo->subscriberId = $subscriberId;
            $subscriberDetailInfo->isSubscribed = false;
            //Save values to session
            $this->sessionManager->saveSubscriberLoginInfo($subscriberDetailInfo);
            $this->redirect('/subscribers/paysubscription');
        } else {
            //$this->response->body(\App\Dto\BaseResponseDto::prepareError(203));
            $this->setAction('signup', [203, FREELANCE_SUB_TYPE]);
        }
    }

    private function _buildFreelanceRegistration($requestData) {
        $subscriberDetails = new \App\Dto\SubscriberRegistrationDto();
        $subscriberDetails->emailId = $requestData['fl_email'];
        $subscriberDetails->password = $requestData['fl_password'];
        $subscriberDetails->country = $requestData['fl_country'];
        $subscriberDetails->mobileNo = $requestData['fl_mob_no'];
        $subscriberDetails->telNo = $requestData['fl_tel_no'];
        $subscriberDetails->nickName = $requestData['nick_name'];
        $subscriberDetails->websiteUrl = $requestData['fl_website_name'];
        $subscriberDetails->name = $requestData['fl_name'];
        $subscriberDetails->subScrType = FREELANCE_SUB_TYPE;
        return $subscriberDetails;
    }

    public function registerCorporate() {
        $subscriberDetails = $this->_buildCorporateRegistration($this->request->data);
        $isDuplicateSubcriber = $this->Subscribers->isSubscriberExists($subscriberDetails->emailId);
        if ($isDuplicateSubcriber) {
            //Throw error
            $this->setAction('signup', 222, CORPORATE_SUB_TYPE);
            return;
        }

        $file = $this->request->data['trade_certificate'];
        if ($file == null) {
            $this->setAction('signup', 237, CORPORATE_SUB_TYPE);
            return;
        }

        $tradeCertificateUrl = \App\Utils\ImageFileUploader::uploadMultipartImage($this->_getWebrootDir(), $file);
        $subscriberDetails->tradeCertificateUrl = $tradeCertificateUrl;
        $subscriberId = $this->Subscribers->registerSubscriber($subscriberDetails);
        if ($subscriberId) {
            //Send welcome email
            try {
                $subscriberPayLaterDetails = $this->Subscribers->getSubscriberDetails($subscriberId);
                \App\Utils\EmailSenderUtility::sendWelcomeEmail($subscriberPayLaterDetails);
            } catch (\Exception $ex) {
                \Cake\Log\Log::error('Error while sending welcome email ' . $ex->getTraceAsString());
            }
            //Build session data to store data
            $subscriberDetailInfo = new \App\Dto\SubscriberDetailedInfo();
            $subscriberDetailInfo->name = $subscriberDetails->name;
            $subscriberDetailInfo->emailId = $subscriberDetails->emailId;
            $subscriberDetailInfo->sType = $subscriberDetails->subScrType;
            $subscriberDetailInfo->subscriberId = $subscriberId;
            $subscriberDetailInfo->isSubscribed = false;
            //Save values to session
            $this->sessionManager->saveSubscriberLoginInfo($subscriberDetailInfo);
            $this->redirect('/subscribers/paysubscription');
        } else {
            //$this->response->body(\App\Dto\BaseResponseDto::prepareError(203));
            $this->setAction('signup', [203, CORPORATE_SUB_TYPE]);
        }
    }

    private function _buildCorporateRegistration($requestData) {
        $subscriberDetails = new \App\Dto\SubscriberRegistrationDto();
        $subscriberDetails->emailId = $requestData['cor_email'];
        $subscriberDetails->password = $requestData['cor_password'];
        $subscriberDetails->country = $requestData['cor_country'];
        $subscriberDetails->mobileNo = $requestData['cor_mob_no'];
        $subscriberDetails->telNo = $requestData['cor_tel_no'];
        //$subscriberDetails->nickName = $requestData['nick_name'];
        $subscriberDetails->websiteUrl = $requestData['cor_website_name'];
        $subscriberDetails->name = $requestData['cor_business_name'];
        $subscriberDetails->contactPerson = $requestData['cor_represent_name'];
        $subscriberDetails->subScrType = CORPORATE_SUB_TYPE;
        return $subscriberDetails;
    }

    //Web method
    public function portfolio() {
        $isSubscribed = $this->sessionManager->isSubscriberSubscribed();
        if (!$isSubscribed) {
            $this->redirect('/subscribers/login');
            return;
        }
        $subscriberId = $this->sessionManager->getSubscriberId();
        $portfolioTable = new \App\Model\Table\PortfolioTable();
        $portfolioList = $portfolioTable->getPortfolioListbySubscriber($subscriberId);
        $subscriberType = $this->sessionManager->getSubscriberType();
        $addPortfolioAllowed = $this->_isNewPortfolioAllowed($subscriberType, $portfolioList);
        $subscriberDetails = $this->Subscribers->getSubscriberDetailsById($subscriberId);
        $this->set(['portfolioList' => $portfolioList,
            'subscriberDetails' => $subscriberDetails,
            'addPortfolioAllowed' => $addPortfolioAllowed]);
    }

    private function _isNewPortfolioAllowed($subscriberType, $portfolioList) {
        if ($portfolioList == NULL)
            return true;

        if ($subscriberType == CORPORATE_SUB_TYPE) {
            if (count($portfolioList) < IMAGE_CORPORATE_LIMIT) {
                return true;
            } else {
                return false;
            }
        }
        if ($subscriberType == FREELANCE_SUB_TYPE) {
            if (count($portfolioList) < IMAGE_FREELANCE_LIMIT) {
                return true;
            } else {
                return false;
            }
        }
    }

    //Web method
    public function signup($errorCode = null, $subType = null) {
        $activeTab = CORPORATE_SUB_TYPE;
        //Error message display logic
        $errorMessage = null;
        if ($errorCode != null) {
            $errorMessage = \App\Dto\BaseResponseDto::getErrorText($errorCode);
            //If the sub type is corporate then show error in corporate tab
            if ($subType == CORPORATE_SUB_TYPE) {
                $this->set('errorDivCorporateClass', 'error-wrapper error-msg-display-block');
                $this->set('errorDivFreelanceClass', 'error-wrapper error-msg-display-none');
            } else {
                $activeTab = FREELANCE_SUB_TYPE;
                $this->set('errorDivFreelanceClass', 'error-wrapper error-msg-display-block');
                $this->set('errorDivCorporateClass', 'error-wrapper error-msg-display-none');
            }
        } else {
            //Default show none style
            $this->set('errorDivFreelanceClass', 'error-wrapper error-msg-display-none');
            $this->set('errorDivCorporateClass', 'error-wrapper error-msg-display-none');
        }

        $this->set('errorMsg', $errorMessage);
        $this->set('activeTab', $activeTab);
    }

    public function paysubscription($errorCode = null) {
        $subscriberType = $this->sessionManager->getSubscriberType();
        $amount = 0;
        $currency = PAYMENT_CURRENCY;
        if ($subscriberType == FREELANCE_PAYMENT) {
            $amount = FREELANCE_PAYMENT;
        } else {
            $amount = CORPORATE_PAYMENT;
        }

        //Show error for Payment failure
        //Error message display logic
        $errorMessage = null;
        if ($errorCode != null) {
            $errorMessage = \App\Dto\BaseResponseDto::getErrorText($errorCode);
            $this->set('errorDivClass', 'error-wrapper error-msg-display-block');
        } else {
            $this->set('errorDivClass', 'error-wrapper error-msg-display-none');
        }

        $this->set('errorMsg', $errorMessage);
        $this->set(['paymentCurrency' => $currency,
            'paymentAmount' => $amount]);
    }

    //Wed method call
    public function paylater() {
        $subscriberId = $this->sessionManager->getSubscriberId();
        $subscriberDetails = $this->Subscribers->getSubscriberDetails($subscriberId);
        $emailSendSuccess = false;

        try {
            if ($subscriberDetails) {
                \App\Utils\EmailSenderUtility::sendPayLaterEmail($subscriberDetails);
                $emailSendSuccess = true;
            }
        } catch (\Exception $ex) {
            \Cake\Log\Log::error('Could not send pay later email ' . $ex->getTraceAsString());
        }
        $this->redirect('/subscribers/login');
    }

    //API call
    public function signin() {
        $this->apiInitialize();
        $subscriberLoginDetails = \App\Dto\SubscriberUserDto::Deserialize($this->postedData);
        $subscriberDetails = $this->Subscribers->signIn($subscriberLoginDetails);
        if ($subscriberDetails) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(104, $subscriberDetails));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(204));
        }
    }

    //API call
    public function register() {
        $this->apiInitialize();
        $subscriberDetails = \App\Dto\SubscriberRegistrationDto::Deserialize($this->postedData);
        //in case of corporate the subscr type is 1 or in case of freelance it is 2
        $subscriberDetails->subScrType = strtolower($subscriberDetails->subType) == 'c' ?
                CORPORATE_SUB_TYPE : FREELANCE_SUB_TYPE;
        //Check if subscriber with same EMAIL already exists
        $isDuplicateSubcriber = $this->Subscribers->isSubscriberExists($subscriberDetails->emailId);
        if ($isDuplicateSubcriber) {
            //Throw error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(222));
            return;
        }
        //ELSE register subscriber
        $subscriberId = $this->Subscribers->registerSubscriber($subscriberDetails);
        if ($subscriberId) {
            //Send welcome email
            try {
                $subscriberDetails = $this->Subscribers->getSubscriberDetails($subscriberId);
                \App\Utils\EmailSenderUtility::sendWelcomeEmail($subscriberDetails);
            } catch (\Exception $ex) {
                \Cake\Log\Log::error('Error while sending welcome email ' . $ex->getTraceAsString());
            }
            $subscriberRegistrationResponse = new \App\Dto\SubscriberRegistrationResponseDto();
            $subscriberRegistrationResponse->subscriberId = $subscriberId;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(103, $subscriberRegistrationResponse));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(203));
        }
    }

    //API call
    public function updateSubscriber() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        if (!$isAuthorized) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $subscriberProfileUpdateRequest = \App\Dto\SubscriberProfileUpdateRequestDto::Deserialize($this->postedData);
        $updateSuccess = $this->Subscribers->updateSubscriberProfile(
                $subscriberProfileUpdateRequest, $this->postedSubscriberData->subscriberId);
        if ($updateSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(116));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(217));
        }
    }

    public function forgotPassword() {
        $this->apiInitialize();

        $forgotPasswordRequest = \App\Dto\ForgotPasswordRequestDto::Deserialize($this->postedData);
        //Bypass email id for web request
        if ($this->request->data['emailId'] != null) {
            $forgotPasswordRequest->emailId = $this->request->data['emailId'];
        }
        $emailPasswordDto = $this->Subscribers->getSubscriberInfo($forgotPasswordRequest->emailId);
        if ($emailPasswordDto) {
            //$emailSuccess = false;
            try {
                \App\Utils\EmailSenderUtility::sendForgotPasswordEmail($forgotPasswordRequest->emailId, $emailPasswordDto->name, $emailPasswordDto->password);
            } catch (\Exception $exc) {
                \Cake\Log\Log::error('Could not send forgot password email ' . $exc->getTraceAsString());
            }
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(121));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(223));
        }
    }

    public function payLaterEmail() {
        $this->apiInitialize();
        $paylaterRequest = \App\Dto\SubscriberPayLaterRequest::Deserialize($this->postedData);
        $subscriberDetails = $this->Subscribers->getSubscriberDetails($paylaterRequest->subscriberId);
        $emailSendSuccess = false;

        try {
            if ($subscriberDetails) {
                \App\Utils\EmailSenderUtility::sendPayLaterEmail($subscriberDetails);
                $emailSendSuccess = true;
            }
        } catch (\Exception $ex) {
            \Cake\Log\Log::error('Could not pay later email ' . $ex->getTraceAsString());
        }
        if ($emailSendSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(123));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(225));
        }
    }

    public function changeStatus() {
        $this->apiInitialize();
        $statusId = $this->request->data['statusId'];
        $subscriberId = $this->request->data['subscriberId'];
        $statusChanged = false;

        if ($statusId == SUBSCRIBER_ON_HOLD) {
            $statusChanged = $this->Subscribers->changeStatus($subscriberId, SUBSCRIPTION_STATUS_INACTIVE);
        }
        if ($statusId == SUBSCRIBER_ACTIVATE) {
            $statusChanged = $this->Subscribers->changeStatus($subscriberId, SUBSCRIPTION_STATUS_ACTIVE);
        }
        if ($statusId == SUBSCRIBER_BYPASS) {
            $statusChanged = $this->Subscribers->updateSubscriptionInfo($subscriberId);
        }
        //If status changed then update the result
        if ($statusChanged) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(124));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(226));
        }
    }

}
