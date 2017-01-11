<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of PpTransactionInitiationResponseDto
 *
 * @author anand
 */
class PpTransactionInitiationResponseDto {
    //put your code here
    //public $paymentJson;
    public $clientId;
    public $invoiceNumber;
    public $amount;
    public $currency;
    public $amountDesc;
    public $environment;
}
