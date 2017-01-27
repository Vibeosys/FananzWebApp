<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of SubscriberListDto
 *
 * @author anand
 */
class SubscriberListDto {
    //put your code here
    public $subscriberId;
    public $subscriberName;
    public $subscriptionType;
    public $subscriptionStatus;
    public $subscriptionDate; 
    public $isSubscribed;
    public $currentStatusId;
    public $currentActionId;
}
