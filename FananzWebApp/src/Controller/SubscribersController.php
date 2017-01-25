<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Subscribers Controller
 *
 * @property \App\Model\Table\SubscribersTable $Subscribers
 */
class SubscribersController extends AppController {

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
                \Cake\Log\Log::error('Error while sending welcome email '. $ex->getTraceAsString());
            }
            $subscriberRegistrationResponse = new \App\Dto\SubscriberRegistrationResponseDto();
            $subscriberRegistrationResponse->subscriberId = $subscriberId;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(103, $subscriberRegistrationResponse));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(203));
        }
    }

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
            \Cake\Log\Log::error('Could not send forgot password email ' . $exc->getTraceAsString());
        }
        if ($emailSendSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(123));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(225));
        }
    }

}
