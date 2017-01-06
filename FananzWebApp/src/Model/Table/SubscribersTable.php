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
        $newSubscriber->IsActive = 1;
        if ($this->save($newSubscriber)) {
            return true;
        }
        return false;
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
                ->select(['SubscriberId', 'SubscriberName', 'IsSubscribed', 'SubscriptionDate', 'Stype', 'NickName'])
                ->first();

        if ($result) {
            $subscriberDetails = new \App\Dto\SubscriberPostSigninDetailsDto();
            $subscriberDetails->name = $result->SubscriberName;
            $subscriberDetails->nickName = $result->NickName;
            $subscriberDetails->sType = $result->Stype == CORPORATE_SUB_TYPE ? 'c' : 'f';
            $subscriberDetails->isSubscribed = $result->IsSubscribed ? true : false;
            $subscriberDetails->subscriberId = $result->SubscriberId;
        }
        return $subscriberDetails;
    }
    
    /**
     * Updates subscriber profile
     * @param \App\Dto\SubscriberProfileUpdateRequestDto $subscriberProfileUpdateRequest
     * @param int $subscriberId 
     * @return boolean true if success or else false
     */
    public function updateSubscriberProfile($subscriberProfileUpdateRequest, $subscriberId){
        $dbSubscriber = $this->find()
                ->where(['SubscriberId' => $subscriberId])
                ->first();
        
        if($dbSubscriber){
            $dbSubscriber->SubscriberName = $subscriberProfileUpdateRequest->name;
            $dbSubscriber->EmailId = $subscriberProfileUpdateRequest->emailId;
            $dbSubscriber->Password = $subscriberProfileUpdateRequest->password;
            $dbSubscriber->TelephoneNo = $subscriberProfileUpdateRequest->telNo;
            $dbSubscriber->MobileNo = $subscriberProfileUpdateRequest->mobileNo;
            $dbSubscriber->WebsiteUrl = $subscriberProfileUpdateRequest->websiteUrl;
            $dbSubscriber->CountryOfResidence = $subscriberProfileUpdateRequest->country;
            if($dbSubscriber->Stype === CORPORATE_SUB_TYPE){
                $dbSubscriber->BusinessContactPerson = $subscriberProfileUpdateRequest->contactPerson;
            }
            if($dbSubscriber->Stype === FREELANCE_SUB_TYPE){
                $dbSubscriber->Nickname = $subscriberProfileUpdateRequest->nickName;
            }
                    
            if($this->save($dbSubscriber)){
                return true;
            }
        }
        
        return false;
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

}
