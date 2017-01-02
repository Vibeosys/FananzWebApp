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
class EventcategoriesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
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
    public function validationDefault(Validator $validator) {
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

    /**
     * Returns master list of all categories and their subcategories
     * @return \App\Dto\CatSubcatResponseDto[] category subcategory array
     */
    public function getMasterInfo() {
        $this->hasMany('Subcategories', [
            'foreignKey' => 'CatId',
            'className' => 'Subcategories'
        ]);

        $result = $this->find('all')
                ->contain(['Subcategories'])
                ->where(['IsActive' => 1]);

        //If no results returned then return null
        if (!$result) {
            return null;
        }

        $resultArray = $result->toArray();
        $catSubCatList = NULL;
        $recordCounter = 0;

        foreach ($resultArray as $resultRecord) {
            $catSubCatRecord = new \App\Dto\CatSubcatResponseDto();
            $catSubCatRecord->categoryId = $resultRecord->CatId;
            $catSubCatRecord->category = $resultRecord->CatName;
            //Initialize the counters and base objects
            $subCatRecordCounter = 0;
            $subCategories = null;
            foreach ($resultRecord->subcategories as $subcategoryResult) {
                $subcategory = new \App\Dto\SubCategoryDto();
                $subcategory->subCategoryId = $subcategoryResult->SubCatId;
                $subcategory->subCategory = $subcategoryResult->SubCatName;
                $subCategories[$subCatRecordCounter++] = $subcategory;
            }
            $catSubCatRecord->subCategories = $subCategories;
            $catSubCatList[$recordCounter++] = $catSubCatRecord;
        }
        return $catSubCatList;
    }

}
