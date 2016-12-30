<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Cake\Log\Log;

/**
 * Description of ApiController
 *
 * @author anand
 */
class ApiController extends AppController {

    protected $postedJson;
    protected $postedRequest;
    protected $postedData;
    protected $postedUserInfo;
    protected $userAuthenticated;
    protected $empInfo;

    //put your code here
    public function initialize() {
        parent::initialize();
        $this->autoRender = FALSE;
        $this->postedJson = $this->request->input();
        //Log::debug("posted json " . $this->postedJson);
        $this->postedRequest = \App\Dto\BaseRequestDto::Deserialize($this->postedJson);
        $this->postedData = $this->postedRequest->data;
        $this->postedUserInfo = $this->postedRequest->user;
        $this->response->type('json');
    }

    protected function authenticateEmployee() {
        $this->empInfo = \App\Dto\EmpInfoRequestDto::Deserialize($this->postedUserInfo);
        //$this->authenticateEmployee($empInfo);
        $empTable = new \App\Model\Table\EmployeeTable();
        $validated = $empTable->validateEmployee($this->empInfo);
        if (!$validated) {
            $this->userAuthenticated = FALSE;
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(202));
            return;
        } else {
            $this->userAuthenticated = TRUE;
        }
    }

}
