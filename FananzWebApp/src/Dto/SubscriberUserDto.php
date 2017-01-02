<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of SubscriberUserDto
 *
 * @author anand
 */
class SubscriberUserDto extends JsonDeserializer{
    //put your code here
    public $emailId;
    public $password;
    public $subscriberId;
}
