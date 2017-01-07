<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pptransactions Model
 *
 * @method \App\Model\Entity\Pptransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pptransaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pptransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pptransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pptransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pptransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pptransaction findOrCreate($search, callable $callback = null, $options = [])
 */
class PptransactionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('pptransactions');
        $this->displayField('TransId');
        $this->primaryKey('TransId');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->allowEmpty('TransId', 'create');

        $validator
                ->allowEmpty('PaypalTransId');

        $validator
                ->integer('PaymentStatus')
                ->requirePresence('PaymentStatus', 'create')
                ->notEmpty('PaymentStatus');

        $validator
                ->integer('SubscriberId')
                ->requirePresence('SubscriberId', 'create')
                ->notEmpty('SubscriberId');

        $validator
                ->requirePresence('Currency', 'create')
                ->notEmpty('Currency');

        $validator
                ->numeric('Amount')
                ->requirePresence('Amount', 'create')
                ->notEmpty('Amount');

        $validator
                ->dateTime('CompletionDate')
                ->allowEmpty('CompletionDate');

        $validator
                ->allowEmpty('AccessToken');

        return $validator;
    }

    public function initiateNewTransaction($transId, $accessToken, $amount, $subscriberId) {
        $dbTransaction = $this->newEntity();
        $dbTransaction->AccessToken = $accessToken;
        $dbTransaction->TransId = $transId;
        $dbTransaction->Amount = $amount;
        $dbTransaction->SubscriberId = $subscriberId;
        $dbTransaction->Currency = PAYMENT_CURRENCY;
        $dbTransaction->PaymentStatus = PYMT_STATUS_INITIATED;
        if ($this->save($dbTransaction))
            return true;
        return false;
    }

}
