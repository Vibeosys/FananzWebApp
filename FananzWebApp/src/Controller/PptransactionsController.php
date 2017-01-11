<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Pptransactions Controller
 *
 * @property \App\Model\Table\PptransactionsTable $Pptransactions
 */
class PptransactionsController extends AppController {

    public function initiatePayment() {
        $this->apiInitialize();

        $isAuthorized = $this->isSubscriberAuthorised();
        if (!$isAuthorized) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $subscriberTable = new \App\Model\Table\SubscribersTable();
        $subscriberType = $subscriberTable->getSubscriberType($this->postedSubscriberData->subscriberId);
        $amountToCollect = 0;
        if ($subscriberType == FREELANCE_SUB_TYPE) {
            $amountToCollect = FREELANCE_PAYMENT;
        } else {
            $amountToCollect = CORPORATE_PAYMENT;
        }

        /* $clientId = PP_CL_ID;
          $clientSecret = PP_SCR;
          $credentials = new \PayPal\Auth\OAuthTokenCredential($clientId, $clientSecret);
          $accessToken = $credentials->getAccessToken(); */
        $dt = new \Cake\I18n\Time();
        $dtm = $dt->getTimestamp();
        $invoiceNumber = 'FNZ-' . $this->postedSubscriberData->subscriberId . '-' . $dtm;

        //$paymentJson = $this->buildPaymentJson($credentials, $invoiceNumber);

        $initiateSuccess = $this->Pptransactions->initiateNewTransaction
                ($invoiceNumber, $amountToCollect, $this->postedSubscriberData->subscriberId);
        if ($initiateSuccess) {
            $ppTransactionResponse = new \App\Dto\PpTransactionInitiationResponseDto();
            $ppTransactionResponse->amountDesc = 'One time subscription charges';
            $ppTransactionResponse->amount = $amountToCollect;
            $ppTransactionResponse->currency = PAYMENT_CURRENCY;
            $ppTransactionResponse->clientId = PP_CL_ID;
            $ppTransactionResponse->invoiceNumber = $invoiceNumber;
            $ppTransactionResponse->environment = PP_ENV;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(120, $ppTransactionResponse));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(221));
        }
    }

    public function verifyPayment() {
        $this->apiInitialize();

        $isAuthorized = $this->isSubscriberAuthorised();
        if (!$isAuthorized) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $verifyPaymentRequest = \App\Dto\VerifyPaymentRequestDto::Deserialize($this->postedData);
        $clientId = PP_CL_ID;
        $clientSecret = PP_SCR;
        $credentials = new \PayPal\Auth\OAuthTokenCredential($clientId, $clientSecret);
        $apiContext = new \PayPal\Rest\ApiContext($credentials);
        $paypalPayment = new \PayPal\Api\Payment();
        $paymentStatus = '';
        //$paymentInfo = $paypalPayment->get($verifyPaymentRequest->paypalId, $apiContext);
        $paymentInfo = $paypalPayment->get($verifyPaymentRequest->paypalId, $apiContext);
        $paymentState = $paymentInfo->getState();

        $payer = $paymentInfo->getPayer();
        $paymentMethod = $payer->getPaymentMethod();
        $transactions = $paymentInfo->getTransactions();
        $invNo = '';
        foreach ($transactions as $paypalTransaction) {
            //$desc = $paypalTransaction->getDescription(); 
            $invNo = $paypalTransaction->getInvoiceNumber();
        }
        if ($paymentState == 'approved') {
            $paymentStatus = PYMT_STATUS_APPROVED;
        } else {
            $paymentStatus = PYMT_STATUS_REJECTED;
        }

        $updateSuccess = $this->Pptransactions->updateTransactionDetails($invNo, $this->postedSubscriberData->subscriberId, 
                $verifyPaymentRequest->paypalId, $paymentStatus, $paymentMethod);
        if (!$updateSuccess) {
            \Cake\Log\Log::error('Payment table could not be updated for ' . $verifyPaymentRequest->invoiceNo);
        }

        if ($paymentStatus != PYMT_STATUS_APPROVED) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(220));

            //TODO: return with rejected
            \Cake\Log\Log::error('payment info received from Paypal - ' . $paymentInfo->toJSON());
            return;
        }

        $subscribersTable = new \App\Model\Table\SubscribersTable();
        $subscriptionUpdateSuccess = $subscribersTable->updateSubscriptionInfo($this->postedSubscriberData->subscriberId);
        $verifyPaymentResponse = new \App\Dto\VerifyPaymentResponseDto();
        $verifyPaymentResponse->paymentSuccess = true;

        if ($subscriptionUpdateSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(119, $verifyPaymentResponse));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(220));
        }

        //print_r($paymentInfo);
    }

    /*   private function buildPaymentJson($credentials, $invoiceNumber) {
      $apiContext = new \PayPal\Rest\ApiContext($credentials);
      $paypalPayment = new \PayPal\Api\Payment();
      $redirectUrls = new \PayPal\Api\RedirectUrls();
      $redirectUrls->setReturnUrl('http://192.168.1.21/paypal/returnurl');
      $redirectUrls->setCancelUrl('http://192.168.1.21/paypal/cancelurl');
      $paypalPayment->setRedirectUrls($redirectUrls);
      $payer = new \PayPal\Api\Payer();
      $payer->setPaymentMethod('paypal');
      $paypalPayment->setPayer($payer);
      $transaction = new \PayPal\Api\Transaction();
      $transactions[0] = $transaction;
      $invoice = new \PayPal\Api\InvoiceNumber();
      $invoice->setNumber($invoiceNumber);
      //$invoice = new \PayPal\Api\InvoiceNumber($invoiceNumber);
      $amount = new \PayPal\Api\Amount();
      $amount->setCurrency(PAYMENT_CURRENCY);
      //$amount->setDetails('Subscription charges');
      $amount->setTotal(2000);
      $transaction->setAmount($amount);
      //$transaction->setInvoiceNumber($invoice);
      $itemList = new \PayPal\Api\ItemList();
      $item = new \PayPal\Api\Item();
      $item->setName('Subscription Fees');
      //$item->setDescription('Payment from paypal');
      $item->setPrice(2000);
      $item->setQuantity(1);
      $item->setCurrency(PAYMENT_CURRENCY);
      $itemList->addItem($item);
      $transaction->setItemList($itemList);
      $paypalPayment->setTransactions($transactions);
      $paypalPayment->setIntent('authorize');
      $paymentJson = $paypalPayment->create($apiContext);

      return $paymentJson->toJSON();
      } */

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $pptransactions = $this->paginate($this->Pptransactions);

        $this->set(compact('pptransactions'));
        $this->set('_serialize', ['pptransactions']);
    }

    /**
     * View method
     *
     * @param string|null $id Pptransaction id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $pptransaction = $this->Pptransactions->get($id, [
            'contain' => []
        ]);

        $this->set('pptransaction', $pptransaction);
        $this->set('_serialize', ['pptransaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $pptransaction = $this->Pptransactions->newEntity();
        if ($this->request->is('post')) {
            $pptransaction = $this->Pptransactions->patchEntity($pptransaction, $this->request->data);
            if ($this->Pptransactions->save($pptransaction)) {
                $this->Flash->success(__('The pptransaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pptransaction could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pptransaction'));
        $this->set('_serialize', ['pptransaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pptransaction id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $pptransaction = $this->Pptransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pptransaction = $this->Pptransactions->patchEntity($pptransaction, $this->request->data);
            if ($this->Pptransactions->save($pptransaction)) {
                $this->Flash->success(__('The pptransaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pptransaction could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pptransaction'));
        $this->set('_serialize', ['pptransaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pptransaction id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $pptransaction = $this->Pptransactions->get($id);
        if ($this->Pptransactions->delete($pptransaction)) {
            $this->Flash->success(__('The pptransaction has been deleted.'));
        } else {
            $this->Flash->error(__('The pptransaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
