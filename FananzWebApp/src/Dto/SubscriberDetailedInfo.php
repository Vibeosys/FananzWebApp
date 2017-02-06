<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of SubscriberDetailedInfo
 *
 * @author anand
 */
class SubscriberDetailedInfo extends SubscriberPostSigninDetailsDto{
    //put your code here
    public $emailId;
    public $password;
    public $contactPerson;
    public $tradeCertificateUrl;
}
