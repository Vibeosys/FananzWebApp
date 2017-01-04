<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of UserSignupRequestDto
 *
 * @author anand
 */
class UserSignupRequestDto extends JsonDeserializer {
    //put your code here
    public $firstName;
    public $lastName;
    public $emailId;
    public $password;
    public $isFacebookLogin;
    public $phoneNo;
}
