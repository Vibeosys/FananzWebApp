<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Subscribers Controller
 *
 * @property \App\Model\Table\SubscribersTable $Subscribers
 */
class SubscribersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $subscribers = $this->paginate($this->Subscribers);

        $this->set(compact('subscribers'));
        $this->set('_serialize', ['subscribers']);
    }

    /**
     * View method
     *
     * @param string|null $id Subscriber id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $subscriber = $this->Subscribers->get($id, [
            'contain' => []
        ]);

        $this->set('subscriber', $subscriber);
        $this->set('_serialize', ['subscriber']);
    }

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

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $subscriber = $this->Subscribers->newEntity();
        if ($this->request->is('post')) {
            $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->data);
            if ($this->Subscribers->save($subscriber)) {
                $this->Flash->success(__('The subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subscriber could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('subscriber'));
        $this->set('_serialize', ['subscriber']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subscriber id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $subscriber = $this->Subscribers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->data);
            if ($this->Subscribers->save($subscriber)) {
                $this->Flash->success(__('The subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subscriber could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('subscriber'));
        $this->set('_serialize', ['subscriber']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscriber id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $subscriber = $this->Subscribers->get($id);
        if ($this->Subscribers->delete($subscriber)) {
            $this->Flash->success(__('The subscriber has been deleted.'));
        } else {
            $this->Flash->error(__('The subscriber could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
