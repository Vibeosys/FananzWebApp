<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of SubscriberRegistrationDto
 *
 * @author anand
 */
class SubscriberRegistrationDto extends JsonDeserializer {

    //put your code here
    public $subscriberId;
    public $name;
    public $emailId;
    public $password;
    public $contactPerson;
    public $subScrType;
    public $subType;
    public $telNo;
    public $mobileNo;
    public $websiteUrl;
    public $country;
    public $nickName;
    public $tradeCertificateUrl;
}
