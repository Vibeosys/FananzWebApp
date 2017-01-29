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
        204 => 'Login failed for subscriber, please check email or password',
        205 => 'No portfolio added for the subscriber, please try again',
        206 => 'Subscriber is not authorized for the action',
        207 => 'No portfolios found for the subscriber',
        208 => 'No information pertaining to requested portfolio',
        209 => 'This email id is already registered with us, please try forgot password or another email id',
        210 => 'User registration failed, please try again later',
        211 => 'Sorry, the credentials did not match, please try again',
        212 => 'Image could not be uploaded, please try again',
        213 => 'No images found for given portfolio',
        214 => 'Image could not be updated for given portfolio',
        215 => 'Image could not be deleted, please try again',
        216 => 'Portfolio could not be updated, please try again',
        217 => 'Subscriber profile could not be updated, please try again',
        218 => 'Could not initiate payment with Paypal',
        219 => 'Portfolio could not be inactivated',
        220 => 'Payment did not go through, please try again later',
        221 => 'Payment could not be initiated',
        222 => 'This email id already exists, please choose another one or try forgot password',
        223 => 'Sorry, email addresses supplied, is not available with us',
        224 => 'Sorry, error occurred while processing your request, please try again',
        225 => 'Some error occurred, please login',
        226 => 'Status for the subscriber could not be updated',
        227 => 'Category with same name already exist, please name it differently',
        228 => 'Category could not be added, please try again later',
        229 => 'Category could not be updated, please try again later',
        230 => 'Sub category title for the selected category already exist, please name it differently',
        231 => 'Sub category could not be added, please try again',
        232 => 'Sub category could not be updated, please try again',
        233 => 'Selected banner image could not be uploaded',
        234 => 'Banner details could not be saved, please try again later',
        235 => 'Banner could not be deleted',
        236 => 'No advt banner found for the requested type'
       ];
    
    protected $successDictionary = [       
        101 => 'List of available portfolios',
        102 => 'List of categories/subcategories',
        103 => 'Registration was successful',
        104 => 'Subscriber login was successful',
        105 => 'Portfolio successfully added for the subscriber',
        106 => 'List of portfolios for subscribers',
        107 => 'Portfolio details success',
        108 => 'User registration is successful',
        109 => 'User has logged in successfully',
        110 => 'Portfolio email message response',
        111 => 'Image upload success',
        112 => 'Images for given portfolio',
        113 => 'Image was successfully updated for the portfolio',
        114 => 'Image successfully deleted, you can now add a new one',
        115 => 'Portfolio updated successfully',
        116 => 'Subscriber profile updated successfully',
        117 => 'Payment initiation',
        118 => 'Portfolio inactivated successfully',
        119 => 'Payment was successful, please login and add portfolio',
        120 => 'Payment initiated successfully',
        121 => 'Forgot password email is sent successfully',
        122 => 'Thank you for contacting us, we will get back to you soon.',
        123 => 'Email has been successfully sent',
        124 => 'Subscriber status updated successfully',
        125 => 'Category added successfully',
        126 => 'Category updated successfully',
        127 => 'Sub category added successfully',
        128 => 'Sub category updated successfully',
        129 => 'Banner details updated successfully',
        130 => 'Banner deleted successfully',
        131 => 'Banner details'
       ];
    
}
