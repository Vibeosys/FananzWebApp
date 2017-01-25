<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function signUp() {
        $this->apiInitialize();
        $resultUserId = 0;
        $userSignUpRequest = \App\Dto\UserSignupRequestDto::Deserialize($this->postedData);
        $resultUserId = $this->Users->getUserId($userSignUpRequest->emailId);
        //If user is sign up with email and if exists then throw error
        if ($resultUserId && $userSignUpRequest->isFacebookLogin == 0) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(209));
            return;
        }
        //If user id does not exists then register
        if ($resultUserId == 0) {
            $resultUserId = $this->Users->registerUser($userSignUpRequest);
        }
        if ($resultUserId != 0) {
            $userSignupResponse = new \App\Dto\UserSignupResponseDto();
            $userSignupResponse->userId = $resultUserId;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(108, $userSignupResponse));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(210));
        }
    }

    public function forgotPassword() {
        $this->apiInitialize();
        $forgotPasswordRequest = \App\Dto\ForgotPasswordRequestDto::Deserialize($this->postedData);

        $emailPasswordDto = $this->Users->getUserPasswordInfo($forgotPasswordRequest->emailId);
        if ($emailPasswordDto) {
            //$emailSuccess = false;
            try {
                $emailSuccess = \App\Utils\EmailSenderUtility::sendForgotPasswordEmail(
                                $forgotPasswordRequest->emailId, $emailPasswordDto->name, $emailPasswordDto->password);
                //$emailSuccess = $this->sendForgotPasswordEmail();
            } catch (\Exception $exc) {
                \Cake\Log\Log::error('Could not send forgot password email ' . $exc->getTraceAsString());
            }
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(121));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(223));
        }
    }

    public function login() {
        $this->apiInitialize();
        $resulLoginResponse = NULL;
        $userLoginRequest = \App\Dto\UserLoginRequestDto::Deserialize($this->postedData);
        if ($userLoginRequest->isFacebookLogin == 1) {
            $resulLoginResponse = $this->Users->getUserInfo($userLoginRequest->emailId);
        } else {
            $resulLoginResponse = $this->Users->getUserInfoFromCredentials
                    ($userLoginRequest->emailId, $userLoginRequest->password);
        }
        //If user info received then go ahead
        if ($resulLoginResponse) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(109, $resulLoginResponse));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(211));
        }
    }

    public function portfolioRequest() {
        $this->apiInitialize();
        $user = \App\Dto\UserDto::Deserialize($this->postedUserInfo);
        $portfolioRequest = \App\Dto\PortfolioServiceRequestDto::Deserialize($this->postedData);
        $userInfoReceived = $this->Users->getRequestedUserInfo($user->userId, $user->emailId);
        //If the user is not valid then return with thanks
        if (!$userInfoReceived) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(212));
            return;
        }

        $portfolioTable = new \App\Model\Table\PortfolioTable();
        $portfolioInfo = $portfolioTable->getPortfolioDetailsById($portfolioRequest->portfolioId);
        if (!$portfolioInfo) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(213));
            return;
        }

        //Is email sending program a success
        $emailSuccess = false;

        try {
            \App\Utils\EmailSenderUtility::sendPortfolioRequestOnEmail(
                    $portfolioInfo, $userInfoReceived, $portfolioRequest->message);
            $emailSuccess = true;
        } catch (\Exception $ex) {
            \Cake\Log\Log::error('Error while sending email ' . $ex->getTraceAsString());
        }

        //TODO send email with the information available
        $portfolioServiceReqRes = new \App\Dto\PortfolioServiceReqResponseDto();
        $portfolioServiceReqRes->emailSuccess = $emailSuccess;
        $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(110, $portfolioServiceReqRes));
    }

    public function sendContactUsEmail() {
        $this->apiInitialize();
        $contactUsRequest = \App\Dto\ContactUsRequestDto::Deserialize($this->postedData);
        if (!$contactUsRequest) {
            $this->response->body();
            return;
        }
        $emailSendSuccess = false;
        try {
            \App\Utils\EmailSenderUtility::sendContactUsEmail($contactUsRequest);
            $emailSendSuccess = true;
        } catch (\Exception $ex) {
            \Cake\Log\Log::error('Error while sending contact us email - ' . $ex->getTraceAsString());
        }

        if ($emailSendSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(122));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(224));
        }
    }


}
