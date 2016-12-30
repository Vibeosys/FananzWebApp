<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Eventcategories Model
 *
 * @method \App\Model\Entity\Eventcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Eventcategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Eventcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Eventcategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eventcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Eventcategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Eventcategory findOrCreate($search, callable $callback = null)
 */
class EventcategoriesTable extends Table
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

        $this->table('eventcategories');
        $this->displayField('CatId');
        $this->primaryKey('CatId');
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
            ->integer('CatId')
            ->allowEmpty('CatId', 'create');

        $validator
            ->allowEmpty('CatName');

        $validator
            ->allowEmpty('CatShortName');

        $validator
            ->integer('HasSubcat')
            ->allowEmpty('HasSubcat');

        $validator
            ->integer('IsActive')
            ->allowEmpty('IsActive');

        $validator
            ->dateTime('CreatedDate')
            ->allowEmpty('CreatedDate');

        return $validator;
    }
}
