<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

trait ForgotPasswordTrait {

    /**
     * Sending pasword email to customer or subscriber
     * @param string $emailId
     * @param string $name
     * @param string $password
     * @return boolean
     */
    public function sendForgotPasswordEmail($emailId, $name, $password) {
        /*$email = new \Cake\Mailer\Email('gcDubaiProfile');
        $email->emailFormat('html')->template('ForgotPasswordEmail')
                ->viewVars(['email' => $emailId, 'name' => $name, 'password' => $password])
                ->from('info@gc-dubai.com', 'Fananz Support Team')
                ->to($emailId, $name)
                ->subject('Fananz forgot password');
        $emailSendSuccess = $email->send();
        return $emailSendSuccess;*/
    }

}
