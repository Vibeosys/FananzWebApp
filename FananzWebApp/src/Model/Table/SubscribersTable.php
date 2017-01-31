<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subscribers Model
 *
 * @method \App\Model\Entity\Subscriber get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subscriber newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Subscriber[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subscriber|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subscriber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subscriber[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subscriber findOrCreate($search, callable $callback = null)
 */
class SubscribersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('subscribers');
        $this->displayField('SubscriberId');
        $this->primaryKey('SubscriberId');
    }

    private function getTable() {
        return \Cake\ORM\TableRegistry::get('subscribers');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('SubscriberId')
                ->allowEmpty('SubscriberId', 'create');

        $validator
                ->requirePresence('SubscriberName', 'create')
                ->notEmpty('SubscriberName');

        $validator
                ->allowEmpty('BusinessContactPerson');

        $validator
                ->requirePresence('EmailId', 'create')
                ->notEmpty('EmailId');

        $validator
                ->integer('Stype')
                ->allowEmpty('Stype');

        $validator
                ->integer('TelephoneNo')
                ->allowEmpty('TelephoneNo');

        $validator
                ->integer('MobileNo')
                ->allowEmpty('MobileNo');

        $validator
                ->allowEmpty('WebsiteUrl');

        $validator
                ->allowEmpty('CountryOfResidence');

        $validator
                ->allowEmpty('AboutUs');

        $validator
                ->allowEmpty('TradeCertificateUrl');

        $validator
                ->integer('IsSubscribed')
                ->requirePresence('IsSubscribed', 'create')
                ->notEmpty('IsSubscribed');

        $validator
                ->dateTime('SubscriptionDate')
                ->allowEmpty('SubscriptionDate');

        $validator
                ->integer('IsActive')
                ->allowEmpty('IsActive');

        $validator
                ->requirePresence('Password', 'create')
                ->notEmpty('Password');

        $validator
                ->allowEmpty('Nickname');

        return $validator;
    }

    /**
     * Registers subscriber with database
     * @param \App\Dto\SubscriberRegistrationDto $subscriber
     * @return int subscriber id or zero
     */
    public function registerSubscriber($subscriber) {
        $newSubscriber = $this->newEntity();
        $newSubscriber->EmailId = $subscriber->emailId;
        $newSubscriber->Password = $subscriber->password;
        $newSubscriber->SubscriberName = $subscriber->name;
        $newSubscriber->Stype = $subscriber->subScrType;
        $newSubscriber->BusinessContactPerson = $subscriber->contactPerson;
        $newSubscriber->MobileNo = $subscriber->mobileNo;
        $newSubscriber->TelephoneNo = $subscriber->telNo;
        $newSubscriber->WebsiteUrl = $subscriber->websiteUrl;
        $newSubscriber->Nickname = $subscriber->nickName;
        $newSubscriber->CountryOfResidence = $subscriber->country;
        if($subscriber->tradeCertificateUrl != ''){
            $newSubscriber->TradeCertificateUrl = $subscriber->tradeCertificateUrl;
        }
        $newSubscriber->IsActive = 1;
        if ($this->save($newSubscriber)) {
            return $newSubscriber->SubscriberId;
        }
        return 0;
    }

    /**
     * Sign in for subscriber
     * @param \App\Dto\SubscriberUserDto $subscriberLoginDetails
     * @return \App\Dto\SubscriberPostSigninDetailsDto $subscriberDetails
     */
    public function signIn($subscriberLoginDetails) {
        $subscriberDetails = NULL;
        $result = $this->find()
                ->where(['EmailId' => $subscriberLoginDetails->emailId,
                    'Password' => $subscriberLoginDetails->password, 'IsActive' => 1])
                ->select(['SubscriberId',
                    'SubscriberName',
                    'IsSubscribed',
                    'SubscriptionDate',
                    'Stype',
                    'Nickname',
                    'TelephoneNo',
                    'MobileNo',
                    'WebsiteUrl',
                    'CountryOfResidence'])
                ->first();

        if ($result) {
            $subscriberDetails = new \App\Dto\SubscriberPostSigninDetailsDto();
            $subscriberDetails->name = $result->SubscriberName;
            $subscriberDetails->nickName = $result->Nickname == NULL ? "" : $result->Nickname;
            $subscriberDetails->sType = $result->Stype == CORPORATE_SUB_TYPE ? 'c' : 'f';
            $subscriberDetails->isSubscribed = $result->IsSubscribed ? true : false;
            $subscriberDetails->subscriberId = $result->SubscriberId;
            $subscriberDetails->telNo = $result->TelephoneNo;
            $subscriberDetails->mobileNo = $result->MobileNo;
            $subscriberDetails->websiteUrl = $result->WebsiteUrl;
            $subscriberDetails->country = $result->CountryOfResidence;
            $subscriberDetails->subscriptionDate = $result->SubscriptionDate;
        }
        return $subscriberDetails;
    }

    /**
     * Sign in for subscriber
     * @param int $subscriberId 
     * @return \App\Dto\SubscriberDetailedInfo $subscriberDetails
     */
    public function getSubscriberDetailsById($subscriberId) {
        $subscriberDetails = NULL;
        $result = $this->find()
                ->where(['SubscriberId' => $subscriberId])
                ->select(['SubscriberId',
                    'SubscriberName',
                    'EmailId',
                    'IsSubscribed',
                    'SubscriptionDate',
                    'Stype',
                    'Nickname',
                    'TelephoneNo',
                    'MobileNo',
                    'WebsiteUrl',
                    'CountryOfResidence'])
                ->first();

        if ($result) {
            $subscriberDetails = new \App\Dto\SubscriberDetailedInfo();
            $subscriberDetails->name = $result->SubscriberName;
            $subscriberDetails->nickName = $result->Nickname == NULL ? "" : $result->Nickname;
            $subscriberDetails->sType = $result->Stype == CORPORATE_SUB_TYPE ? 'c' : 'f';
            $subscriberDetails->isSubscribed = $result->IsSubscribed ? true : false;
            $subscriberDetails->subscriberId = $result->SubscriberId;
            $subscriberDetails->telNo = $result->TelephoneNo;
            $subscriberDetails->mobileNo = $result->MobileNo;
            $subscriberDetails->websiteUrl = $result->WebsiteUrl;
            $subscriberDetails->country = $result->CountryOfResidence;
            $subscriberDetails->subscriptionDate = $result->SubscriptionDate;
            $subscriberDetails->emailId = $result->EmailId;
        }
        return $subscriberDetails;
    }
    
    /**
     * Updates subscriber profile
     * @param \App\Dto\SubscriberProfileUpdateRequestDto $subscriberProfileUpdateRequest
     * @param int $subscriberId 
     * @return boolean true if success or else false
     */
    public function updateSubscriberProfile($subscriberProfileUpdateRequest, $subscriberId) {
        $dbSubscriber = $this->find()
                ->where(['SubscriberId' => $subscriberId])
                ->first();

        if ($dbSubscriber) {
            $dbSubscriber->SubscriberName = $subscriberProfileUpdateRequest->name;
            $dbSubscriber->EmailId = $subscriberProfileUpdateRequest->emailId;
            $dbSubscriber->Password = $subscriberProfileUpdateRequest->password;
            $dbSubscriber->TelephoneNo = $subscriberProfileUpdateRequest->telNo;
            $dbSubscriber->MobileNo = $subscriberProfileUpdateRequest->mobileNo;
            $dbSubscriber->WebsiteUrl = $subscriberProfileUpdateRequest->websiteUrl;
            $dbSubscriber->CountryOfResidence = $subscriberProfileUpdateRequest->country;
            if ($dbSubscriber->Stype === CORPORATE_SUB_TYPE) {
                $dbSubscriber->BusinessContactPerson = $subscriberProfileUpdateRequest->contactPerson;
            }
            if ($dbSubscriber->Stype === FREELANCE_SUB_TYPE) {
                $dbSubscriber->Nickname = $subscriberProfileUpdateRequest->nickName;
            }

            if ($this->save($dbSubscriber)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets subscriber info for the requested email id
     * @param string $emailId
     * @return \App\Dto\EmailPasswordDto
     */
    public function getSubscriberInfo($emailId) {
        $emailPassword = null;
        $dbSubscriber = $this->find()
                ->where(['EmailId' => $emailId])
                ->select(['SubscriberName', 'Password'])
                ->first();

        if ($dbSubscriber) {
            $emailPassword = new \App\Dto\EmailPasswordDto();
            $emailPassword->name = $dbSubscriber->SubscriberName;
            $emailPassword->password = $dbSubscriber->Password;
        }
        return $emailPassword;
    }

    /**
     * Validates subscriber against login details
     * @param \App\Dto\SubscriberUserDto $subscriberUserDetails
     */
    public function validateSubscriber($subscriberUserDetails) {
        $validated = $this->getTable()->exists(['SubscriberId' => $subscriberUserDetails->subscriberId,
            'EmailId' => $subscriberUserDetails->emailId, 'Password' => $subscriberUserDetails->password]);

        return $validated;
    }

    /**
     * Check if subscriber email id already exist
     * @param string $emailId
     * @return bool
     */
    public function isSubscriberExists($emailId) {
        $subscriberExists = $this->getTable()->exists(['EmailId' => $emailId]);

        return $subscriberExists;
    }

    /**
     * Gets subscriber type from databse
     * @param int $subscriberId
     * @return int
     */
    public function getSubscriberType($subscriberId) {
        $result = $this->getTable()->find()
                ->where(['SubscriberId' => $subscriberId])
                ->select(['Stype'])
                ->first();

        return $result->Stype;
    }

    /**
     * Update subscriber subscription information
     * @param int $subscriberId
     * @return boolean
     */
    public function updateSubscriptionInfo($subscriberId) {
        $dbSubcriberRecord = $this->getTable()->find()
                ->where(['SubscriberId' => $subscriberId])
                ->select(['IsSubscribed', 'SubscriptionDate', 'SubscriberId'])
                ->first();

        if ($dbSubcriberRecord) {
            $dbSubcriberRecord->IsSubscribed = 1;
            $tm = new \Cake\I18n\Time();
            $dbSubcriberRecord->SubscriptionDate = $tm->now();
            if ($this->getTable()->save($dbSubcriberRecord)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Gets subscriber details for a given subscriber id
     * @param type $subscriberId
     * @return \App\Dto\SubscriberPayLaterDto
     */
    public function getSubscriberDetails($subscriberId) {
        $subscriberDetails = NULL;
        $result = $this->find()
                ->where(['SubscriberId' => $subscriberId])
                ->select(['SubscriberId',
                    'SubscriberName',
                    'Stype',
                    'EmailId',
                    'MobileNo',
                    'CountryOfResidence'])
                ->first();

        if ($result) {
            $subscriberDetails = new \App\Dto\SubscriberPayLaterDto();
            $subscriberDetails->name = $result->SubscriberName;
            $subscriberDetails->sType = $result->Stype == CORPORATE_SUB_TYPE ? 'Corporate' : 'Freelance';
            $subscriberDetails->mobileNo = $result->MobileNo;
            $subscriberDetails->country = $result->CountryOfResidence;
            $subscriberDetails->emailId = $result->EmailId;
        }
        return $subscriberDetails;
    }

    /**
     * Returns list of records for a requested page size and limit of records
     * @param int $limit
     * @param int $pageNo
     * @return \App\Dto\SubscriberListDto
     */
    public function getSubscriberList($limit, $pageNo) {
        $subscriberList = null;
        $result = $this->getTable()->find()
                ->select(['SubscriberId',
                    'SubscriberName',
                    'Stype',
                    'SubscriptionDate',
                    'IsSubscribed',
                    'IsActive'])
                ->page($pageNo, $limit)
                ->all();
        
        $recordCounter = 0;
        foreach ($result as $subscriberRecord) {
            $subscriberListRecord = new \App\Dto\SubscriberListDto();
            $subscriberListRecord->subscriberId = $subscriberRecord->SubscriberId;
            $subscriberListRecord->subscriberName = $subscriberRecord->SubscriberName;
            $subscriberListRecord->subscriptionType = $subscriberRecord->Stype == CORPORATE_SUB_TYPE ? 'Corporate' : 'Freelance';
            if ($subscriberRecord->SubscriptionDate == null) {
                $subscriberListRecord->subscriptionDate = 'N/A';
            } else {
                $tm = new \Cake\I18n\Time($subscriberRecord->SubscriptionDate);
                $subscriberListRecord->subscriptionDate = $tm->format('d M Y');
            }
            $subscriberListRecord->currentStatusId = $subscriberRecord->IsActive;
            $subscriberListRecord->isSubscribed = $subscriberRecord->IsSubscribed;
            $subscriberList[$recordCounter++] = $subscriberListRecord;
        }

        return $subscriberList;
    }

    public function getTotalRecordCount(){
        $totalRecords = $this->getTable()->find()->count();
        return $totalRecords;
    }
    
    /**
     * Status change from active to inactive or vice versa
     * @param int $subscriberId
     * @param int $status
     * @return boolean
     */
    public function changeStatus($subscriberId, $status){
        $statusChanged = false;
        $dbSubscriber = $this->find()
                ->where(['SubscriberId' => $subscriberId])
                ->select(['SubscriberId', 'IsActive'])
                ->first();
        
        if($dbSubscriber){
            $dbSubscriber->IsActive = $status;
            if($this->save($dbSubscriber)){
                $statusChanged = true;
            }
        }
        return $statusChanged;
    }
}
