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
        $invoiceNumber = $this->getInvoiceNo($this->postedSubscriberData->subscriberId);
        /* $dt = new \Cake\I18n\Time();
          $dtm = $dt->getTimestamp();
          $invoiceNumber = 'FNZ-' . $this->postedSubscriberData->subscriberId . '-' . $dtm; */

        //$paymentJson = $this->buildPaymentJson($credentials, $invoiceNumber);

        $initiateSuccess = $this->Pptransactions->initiateNewTransaction
                ($invoiceNumber, $amountToCollect, $this->postedSubscriberData->subscriberId);
        if ($initiateSuccess) {
            $ppTransactionResponse = new \App\Dto\PpTransactionInitiationResponseDto();
            $ppTransactionResponse->amountDesc = 'Annual subscription charges';
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

        $updateSuccess = $this->Pptransactions->updateTransactionDetails($invNo, $this->postedSubscriberData->subscriberId, $verifyPaymentRequest->paypalId, $paymentStatus, $paymentMethod);
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

    private function getInvoiceNo($subscriberId) {
        $dt = new \Cake\I18n\Time();
        $dtm = $dt->getTimestamp();
        $invoiceNumber = 'FNZ-' . $subscriberId . '-' . $dtm;
        return $invoiceNumber;
    }

    //Initiate web paypal integration
    public function initpayment() {
        $clientId = PP_CL_ID;
        $clientSecret = PP_SCR;
        $credentials = new \PayPal\Auth\OAuthTokenCredential($clientId, $clientSecret);
        $subscriberId = $this->sessionManager->getSubscriberId();
        $subscriberType = $this->sessionManager->getSubscriberType();
        $invoiceNumber = $this->getInvoiceNo($subscriberId);
        $amountToCollect = 0;
        if ($subscriberType == FREELANCE_SUB_TYPE) {
            $amountToCollect = FREELANCE_PAYMENT;
        } else {
            $amountToCollect = CORPORATE_PAYMENT;
        }
        $initiateSuccess = $this->Pptransactions->initiateNewTransaction
                ($invoiceNumber, $amountToCollect, $subscriberId);
        if ($initiateSuccess) {
            \Cake\Log\Log::info('No record could be added to database');
        }
        $paypalInfo = $this->buildPayment($credentials, $invoiceNumber, $amountToCollect);
        //Update it to database
        $updated = $this->Pptransactions->updatePaypalIdForInvoice($paypalInfo->paypalId, $paypalInfo->invoiceNumber);

        $this->redirect($paypalInfo->approvalUrl);
    }

    //Get the response from paypal and verify payment for Website
    public function paypal() {
        $paymentId = $this->request->query('paymentId');
        $payerId = $this->request->query('PayerID');
        $subscriberId = $this->sessionManager->getSubscriberId();

        $clientId = PP_CL_ID;
        $clientSecret = PP_SCR;
        $credentials = new \PayPal\Auth\OAuthTokenCredential($clientId, $clientSecret);
        $apiContext = new \PayPal\Rest\ApiContext($credentials);
        $paypalPayment = new \PayPal\Api\Payment();
        $paymentStatus = '';
        //$paymentInfo = $paypalPayment->get($verifyPaymentRequest->paypalId, $apiContext);
        $paymentInfo = $paypalPayment->get($paymentId, $apiContext);
        $paymentState = $paymentInfo->getState();
        $paypalResponse = null;
        if ($paymentState == 'created') {
            $paypalPayment->setId($paymentId);

            //Continue for the payment execution
            $paymentExecution = new \PayPal\Api\PaymentExecution();
            $paymentExecution->setCredential($credentials);
            $paymentExecution->setPayerId($payerId);
            $paypalResponse = $paypalPayment->execute($paymentExecution);

            //Get the details of the latest executed payment
            $paymentInfo = $paypalPayment->get($paymentId, $apiContext);
            $paymentState = $paymentInfo->getState();
        }

        $payer = $paymentInfo->getPayer();
        $paymentMethod = $payer->getPaymentMethod();
        //$transactions = $paymentInfo->getTransactions();

        if ($paymentState == 'approved') {
            $paymentStatus = PYMT_STATUS_APPROVED;
        } else {
            $paymentStatus = PYMT_STATUS_REJECTED;
        }

        $updateSuccess = $this->Pptransactions->updateTransactionsForPaypal
                ($subscriberId, $paymentId, $paymentStatus, $paymentMethod);
        if (!$updateSuccess) {
            \Cake\Log\Log::error('Payment table could not be updated for ' . $paymentId);
        }

        if ($paymentStatus != PYMT_STATUS_APPROVED) {
            //TODO: return with rejected
            \Cake\Log\Log::error('payment info received from Paypal - ' . $paymentInfo->toJSON());
            $this->redirect('/subscribers/paysubscription/220');
            return;
        }

        $subscribersTable = new \App\Model\Table\SubscribersTable();
        $subscriptionUpdateSuccess = $subscribersTable->updateSubscriptionInfo($subscriberId);
        if ($subscriptionUpdateSuccess) {
            $this->sessionManager->changeSubscriberStatus();
        }
        $this->redirect('/subscribers/portfolio');
    }

    /**
     * Build paypal payment
     * @param type $credentials
     * @param type $invoiceNumber
     * @param type $amountInUsd
     * @return \App\Dto\PaypalInfoAddDto
     */
    private function buildPayment($credentials, $invoiceNumber, $amountInUsd) {
        $apiContext = new \PayPal\Rest\ApiContext($credentials);
        $paypalPayment = new \PayPal\Api\Payment();
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl('http://localhost:9090/FananzWebApp/pptransactions/paypal');
        $redirectUrls->setCancelUrl('http://localhost:9090/FananzWebApp/pptransactions/paypal');
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
        $amount->setTotal($amountInUsd);
        $transaction->setAmount($amount);

        $itemList = new \PayPal\Api\ItemList();
        $item = new \PayPal\Api\Item();
        $item->setName('Annual subscription fees');
        //$item->setDescription('Payment from paypal');
        $item->setPrice($amountInUsd);
        $item->setQuantity(1);
        $item->setCurrency(PAYMENT_CURRENCY);
        $itemList->addItem($item);
        $transaction->setItemList($itemList);
        //$transaction->setInvoiceNumber($invoice);
        $paypalPayment->setTransactions($transactions);
        $paypalPayment->setIntent('sale');
        $paymentJson = $paypalPayment->create($apiContext);
        $paypalId = $paymentJson->getId();
        $approvalLink = $paymentJson->getApprovalLink();

        $paypalInfo = new \App\Dto\PaypalInfoAddDto();
        $paypalInfo->approvalUrl = $approvalLink;
        $paypalInfo->paypalId = $paypalId;
        $paypalInfo->invoiceNumber = $invoiceNumber;

        return $paypalInfo;
    }

}
