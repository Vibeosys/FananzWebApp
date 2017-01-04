<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('UserId');
        $this->primaryKey('UserId');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('UserId')
                ->allowEmpty('UserId', 'create');

        $validator
                ->requirePresence('FirstName', 'create')
                ->notEmpty('FirstName');

        $validator
                ->allowEmpty('LastName');

        $validator
                ->requirePresence('EmailId', 'create')
                ->notEmpty('EmailId');

        $validator
                ->requirePresence('Password', 'create')
                ->notEmpty('Password');

        $validator
                ->allowEmpty('MobileNo');

        $validator
                ->integer('IsFacebookUser')
                ->allowEmpty('IsFacebookUser');

        $validator
                ->integer('IsActive')
                ->allowEmpty('IsActive');

        return $validator;
    }

    /**
     * Gets user id for email id
     * @param string $emailId
     * @return int
     */
    public function getUserId($emailId) {
        $result = $this->find()
                ->where(['EmailId' => $emailId])
                ->select('UserId')
                ->first();
        //IF user id is received then return the same
        if ($result) {
            return $result;
        }
        //else return 0
        return 0;
    }

    /**
     * Gets user id for email id
     * @param string $emailId
     * @return \App\Dto\UserLoginResponseDto $userInfo
     */
    public function getUserInfo($emailId) {
        $userInfo = NULL;
        $result = $this->find()
                ->where(['EmailId' => $emailId])
                ->select(['UserId', 'FirstName', 'LastName'])
                ->first();
        //IF user id is received then return the same
        if ($result) {
            $userInfo = new \App\Dto\UserLoginResponseDto();
            $userInfo->userId = $result->UserId;
            $userInfo->firstName = $result->FirstName;
            $userInfo->lastName = $result->LastName;
            return $userInfo;
        }
        //else return 0
        return $userInfo;
    }
    
    /**
     * Gets information about the user
     * @param int $userId
     * @param string $emailId
     * @return \App\Dto\RequestedUserInfoDto $userInfo
     */
    public function getRequestedUserInfo($userId, $emailId){
        $userInfo = NULL;
        $result = $this->find()
                ->where(['EmailId' => $emailId, 'UserId' => $userId])
                ->select(['UserId', 'FirstName', 'LastName', 'MobileNo'])
                ->first();
        //IF user info is received then return the same
        if ($result) {
            $userInfo = new \App\Dto\RequestedUserInfoDto();
            $userInfo->userId = $result->UserId;
            $userInfo->firstName = $result->FirstName;
            $userInfo->lastName = $result->LastName;
            $userInfo->phoneNo = $result->MobileNo;
            return $userInfo;
        }
        //else return null
        return $userInfo;
    }

    /**
     * Gets user id for email id and password
     * @param string $emailId
     * @param string $password 
     * @return \App\Dto\UserLoginResponseDto $userInfo
     */
    public function getUserInfoFromCredentials($emailId, $password) {
        $userInfo = NULL;
        $result = $this->find()
                ->where(['EmailId' => $emailId, 'Password' => $password])
                ->select(['UserId', 'FirstName', 'LastName'])
                ->first();

        //IF user id is received then return the same
        if ($result) {
            $userInfo = new \App\Dto\UserLoginResponseDto();
            $userInfo->userId = $result->UserId;
            $userInfo->firstName = $result->FirstName;
            $userInfo->lastName = $result->LastName;
            return $userInfo;
        }
        //else return user info
        return $userInfo;
    }

    /**
     * Registers user and returns user id
     * @param \App\Dto\UserSignupRequestDto $userSignUpRequest
     * @return int 
     */
    public function registerUser($userSignUpRequest) {
        $userEntity = $this->newEntity();
        $userEntity->EmailId = $userSignUpRequest->emailId;
        $userEntity->FirstName = $userSignUpRequest->firstName;
        $userEntity->LastName = $userSignUpRequest->lastName;
        $userEntity->Password = $userSignUpRequest->password;
        $userEntity->IsFacebookUser = $userSignUpRequest->isFacebookLogin;
        $userEntity->MobileNo = $userSignUpRequest->phoneNo;
        $userEntity->IsActive = 1;
        if ($this->save($userEntity)) {
            return $userEntity->UserId;
        } else {
            return 0;
        }
    }

}
