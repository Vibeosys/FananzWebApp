<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of SubscriberProfileUpdateRequestDto
 *
 * @author anand
 */
class SubscriberProfileUpdateRequestDto extends JsonDeserializer {

    //put your code here
    public $name;
    public $emailId;
    public $password;
    public $contactPerson;
    public $telNo;
    public $mobileNo;
    public $websiteUrl;
    public $country;
    public $nickName;

}
