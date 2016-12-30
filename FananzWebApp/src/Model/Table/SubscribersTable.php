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
class SubscribersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('subscribers');
        $this->displayField('SubscriberId');
        $this->primaryKey('SubscriberId');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
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
}
