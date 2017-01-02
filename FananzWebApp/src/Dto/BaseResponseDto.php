<?php
namespace App\Dto;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsErrorDto
 *
 * @author niteen
 */
class BaseResponseDto {
    
    public $errorCode;
    public $message;
    public $data;


    //format {"errorCode":"100", "message":"User is not authenticated"}
    public static function prepareError($errorcode) {
        $baseResponse = new BaseResponseDto();
        $baseResponse->errorCode = $errorcode;
        $baseResponse->message = $baseResponse->errorDictionary[$errorcode];
        return json_encode($baseResponse);
    }
    
     public static function prepareSuccessMessage($successCode, $data = 0) {
        $baseResponse = new BaseResponseDto();
        $baseResponse->errorCode = 0;
        $baseResponse->message =$baseResponse->successDictionary[$successCode];
        $baseResponse->data = $data;
        return json_encode($baseResponse);
    }
    
    public static function prepareJsonSuccessMessage($successCode, $data = 0) {
        $baseResponse = new BaseResponseDto();
        $baseResponse->errorCode = 0;
        $baseResponse->message =$baseResponse->successDictionary[$successCode];
        $baseResponse->data = json_encode($data);
        return json_encode($baseResponse);
    }

    
    protected $errorDictionary = [
        201 => 'Sorry, no portfolio available, please send special request to reach to you',
        202 => 'No categories yet added, do you want to suggest something',
        203 => 'Sorry, your registration was unsuccessful',
        204 => 'Login failed for subscriber, please check email or password'
       ];
    
    protected $successDictionary = [       
        101 => 'List of available portfolios',
        102 => 'List of categories/subcategories',
        103 => 'Registration was successful',
        104 => 'Subscriber login was successful'
       ];
    
}
