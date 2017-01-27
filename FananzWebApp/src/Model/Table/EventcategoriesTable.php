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

    private function connect() {
        return \Cake\ORM\TableRegistry::get('eventcategories');
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

    public function getCategories() {
        $categoryList = [0 => 'Select Category'];

        $categoryResult = $this->connect()->find()
                ->select(['CatId', 'CatName'])
                ->all();

        foreach ($categoryResult as $catRecord) {
            $categoryList[$catRecord->CatId] = $catRecord->CatName;
        }

        return $categoryList;
    }

    /**
     * Gets lists of categories and subcategories
     * @return \App\Dto\FindCategoriesDto
     */
    public function getCategoriesAndSubcategories() {

        $this->connect()->hasMany('Subcategories', [
            'foreignKey' => 'CatId',
            'className' => 'Subcategories'
        ]);

        $resultdata = $this->connect()->find('all')
                ->contain(['Subcategories'])
                ->where(['IsActive' => 1]);

        //If no results returned then return null
        if (!$resultdata) {
            return null;
        }

        $resultArrayData = $resultdata->toArray();
        //  $catSubCatList = NULL;
        $categoriessubcatgories = null;
        $recordCounter = 0;

        foreach ($resultArrayData as $resultRecordData) {
            $FindCategoriesRecord = new \App\Dto\FindCategoriesDto();
            $FindCategoriesRecord->categoryId = $resultRecordData->CatId;
            $FindCategoriesRecord->category = $resultRecordData->CatName;
            $FindCategoriesRecord->categoryShortName = $resultRecordData->CatShortName;
            //Initialize the counters and base objects
            $subCatRecordCounter = 0;
            $subCategories = null;
            foreach ($resultRecordData->subcategories as $subcategoryResult) {
                $subcategory = new \App\Dto\FindSubcategoryDto();
                $subcategory->subCategoryId = $subcategoryResult->SubCatId;
                $subcategory->subCategory = $subcategoryResult->SubCatName;
                $subcategory->subCategoryShortName = $subcategoryResult->SubCatShortName;
                $subCategories[$subCatRecordCounter++] = $subcategory;
            }
            $FindCategoriesRecord->subCategories = $subCategories;
            $categoriessubcatgories[$recordCounter++] = $FindCategoriesRecord;
        }
        return $categoriessubcatgories;
    }

    public function getCategoryId($shortName) {
        $categoryId = 0;
        $dbCategory = $this->connect()->find()
                ->where(['catShortName' => $shortName])
                ->select(['CatId'])
                ->first();


        if ($dbCategory) {
            $categoryId = $dbCategory->CatId;
        }
        return $categoryId;
    }

    public function categoryExists($categoryNameInLowerCase) {
        $categoryNameExists = $this->exists(['lower(CatName)' => $categoryNameInLowerCase]);
        return $categoryNameExists;
    }

    /**
     * Category addition
     * @param string $categoryName
     * @param string $catShortName
     * @return boolean
     */
    public function addNewCategory($categoryName, $catShortName) {
        $categoryAdded = false;
        $dbEntity = $this->newEntity();
        $dbEntity->CatName = $categoryName;
        $dbEntity->CatShortName = $catShortName;
        $dbEntity->IsActive = 1;
        $dbEntity->HasSubcat = 0;
        $dbEntity->CreatedDate = new \Cake\I18n\Time();

        if ($this->save($dbEntity)) {
            $categoryAdded = true;
        }
        return $categoryAdded;
    }

}
