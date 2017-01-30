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
                $this->setAction('portfolio');
            } else {
                $this->setAction('paysubscription');
            }
        } else {
            $this->setAction('login', 204);
        }
    }

    //Web method
    public function portfolio() {
        $isSubscribed = $this->sessionManager->isSubscriberSubscribed();
    }

    //Web method
    public function signup() {
        
    }

    public function paysubscription() {
        $subscriberType = $this->sessionManager->getSubscriberType();
        $amount = 0;
        $currency = PAYMENT_CURRENCY;
        if ($subscriberType == FREELANCE_PAYMENT) {
            $amount = FREELANCE_PAYMENT;
        } else {
            $amount = CORPORATE_PAYMENT;
        }

        $this->set(['paymentCurrency' => $currency,
            'paymentAmount' => $amount]);
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
