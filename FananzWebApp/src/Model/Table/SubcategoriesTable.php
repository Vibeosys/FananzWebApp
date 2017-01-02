<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subcategories Model
 *
 * @method \App\Model\Entity\Subcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subcategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Subcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subcategory findOrCreate($search, callable $callback = null)
 */
class SubcategoriesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('subcategories');
        $this->displayField('SubCatId');
        $this->primaryKey('SubCatId');
        $this->belongsTo('eventcategories', [
            'foreignKey' => 'CatId'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('SubCatId')
                ->allowEmpty('SubCatId', 'create');

        $validator
                ->allowEmpty('SubCatName');

        $validator
                ->allowEmpty('SubCatShortName');

        $validator
                ->integer('CatId')
                ->requirePresence('CatId', 'create')
                ->notEmpty('CatId');

        $validator
                ->integer('IsActive')
                ->allowEmpty('IsActive');

        $validator
                ->dateTime('DateCreated')
                ->allowEmpty('DateCreated');

        return $validator;
    }

    /**
     * Gets list of master data from categories and subcategories
     * @return \App\Dto\CatSubcatResponseDto[] $catSubCatList
     */
    /*public function getMasterInfo() {
        $this->belongsTo('eventcategories', [
            'foreignKey' => 'CatId'
        ]);

        $result = $this->find('all')
                ->contain(['eventcategories'])
                ->where(['eventcategories.IsActive' => 1])
                ->select(['eventcategories.CatId', 'eventcategories.CatName', 'SubCatId', 'SubCatName']);

        //If no results returned then return null
        if (!$result) {
            return null;
        }
        $resultArray = $result->toArray();
        $catSubCatList = NULL;
        $recordCounter = 0;
        foreach ($resultArray as $resultRecord) {
            $catSubCatRecord = new \App\Dto\CatSubcatResponseDto();
            $catSubCatRecord->categoryId = $resultRecord->eventcategory->CatId;
            $catSubCatRecord->category = $resultRecord->eventcategory->CatName;
            $catSubCatRecord->subCategoryId = $resultRecord->SubCatId;
            $catSubCatRecord->subCategory = $resultRecord->SubCatName;
            $catSubCatList[$recordCounter++] = $catSubCatRecord;
        }
        return $catSubCatList;
    }*/

}
