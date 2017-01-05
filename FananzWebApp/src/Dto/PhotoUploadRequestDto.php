<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of PhotoUploadRequestDto
 *
 * @author anand
 */
class PhotoUploadRequestDto extends JsonDeserializer {
    //put your code here
    public $portfolioId;
    public $subscriberId;
    public $emailId;
    public $password;
    public $isCoverImageUpload;
}
