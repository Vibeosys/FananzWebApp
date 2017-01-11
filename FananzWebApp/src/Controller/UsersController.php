<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    use \App\Utils\ForgotPasswordTrait;
    
    protected $_toEmailAddresses = [
        'anand@vibeosys.com',
        //'kaladdin@gmail.com',
        //'Kaladdin@gc-dubai.com'
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

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

    public function forgotPassword(){
        $this->apiInitialize();
        $forgotPasswordRequest = \App\Dto\ForgotPasswordRequestDto::Deserialize($this->postedData);

        $emailPasswordDto = $this->Users->getUserPasswordInfo($forgotPasswordRequest->emailId);
        if ($emailPasswordDto) {
            //$emailSuccess = false;
            try {
                $emailSuccess = $this->sendForgotPasswordEmail($forgotPasswordRequest->emailId, 
                        $emailPasswordDto->name, $emailPasswordDto->password);
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
            $this->sendPortfolioRequestOnEmail(
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

    /**
     * Sends email to admin about the service request
     * @param \App\Dto\PortfolioEmailDetailsDto $portfolioInfo
     * @param \App\Dto\RequestedUserInfoDto $userInfo
     * @param string $message Message from customer
     */
    private function sendPortfolioRequestOnEmail($portfolioInfo, $userInfo, $message) {
        $email = new \Cake\Mailer\Email('gcDubaiProfile');
        $email->emailFormat('html')->template('ServiceRequestEmail')
                ->viewVars(['portfolio' => $portfolioInfo, 'customer' => $userInfo, 'message' => $message])
                ->from('info@gc-dubai.com', 'Fananz Support Team')
                ->addTo($this->_toEmailAddresses)
                ->subject('Fananz service request');
        $emailSendSuccess = $email->send();
        return $emailSendSuccess;
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
