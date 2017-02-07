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

    private function getTable() {
        return \Cake\ORM\TableRegistry::get('subcategories');
    }

    /**
     * Gets category id for a short name
     * @param string $subCatShortName
     * @return int
     */
    public function getSubCategoryId($subCatShortName) {
        $subCategoryId = 0;

        $dbSubcategory = $this->getTable()->find()
                ->where(['SubCatShortName' => $subCatShortName])
                ->select(['SubCatId'])
                ->first();

        if ($dbSubcategory) {
            $subCategoryId = $dbSubcategory->SubCatId;
        }
        return $subCategoryId;
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
     * Adds new subcategory for existing category
     * @param int $categoryId
     * @param string $subCategoryName
     * @param string $subCategoryShortName
     * @return boolean
     */
    public function addNewSubcategory($categoryId, $subCategoryName, $subCategoryShortName) {
        $entityAdded = false;
        $dbSubcategory = $this->newEntity();
        $dbSubcategory->CatId = $categoryId;
        $dbSubcategory->SubCatName = $subCategoryName;
        $dbSubcategory->SubCatShortName = $subCategoryShortName;
        $dbSubcategory->DateCreated = new \Cake\I18n\Time();
        $dbSubcategory->IsActive = 1;
        if ($this->save($dbSubcategory)) {
            $entityAdded = true;
        }
        return $entityAdded;
    }

    /**
     * Updates existing subcategory for
     * @param int $subCategoryId
     * @param string $subCategoryName
     * @return boolean
     */
    public function updateSubcategory($subCategoryId, $subCategoryName) {
        $subcategoryUpdated = false;
        $dbSubcategory = $this->find()
                ->where(['SubCatId' => $subCategoryId])
                ->select(['SubCatName', 'SubCatId'])
                ->first();

        if ($dbSubcategory) {
            $dbSubcategory->SubCatName = $subCategoryName;
            if ($this->save($dbSubcategory)) {
                $subcategoryUpdated = true;
            }
        }
        return $subcategoryUpdated;
    }

    /**
     * Gets the list of subcategories for a given category
     * @param int $categoryId
     * @return array
     */
    public function getSubCategoryList($categoryId) {
        $subCategoryList = [];
        $subCategoryList[0] = 'Select sub category';
        $dbResult = $this->getTable()->find()
                ->where(['CatId' => $categoryId])
                ->select(['SubCatId', 'SubCatName'])
                ->all();

        if ($dbResult) {
            $dbResultArray = $dbResult->toArray();
            foreach ($dbResultArray as $subCatRecord) {
                $subCategoryList[$subCatRecord->SubCatId] = $subCatRecord->SubCatName;
            }
        }

        return $subCategoryList;
    }

    /**
     * Check if subcategory with the same name exist for the given category
     * @param string $subCategoryNameInLowerCase
     * @param int $categoryId
     * @return boolean
     */
    public function checkSubcategoryExists($subCategoryNameInLowerCase, $categoryId) {
        $subCategoryNameExists = $this->exists([
            'lower(SubCatName)' => $subCategoryNameInLowerCase,
            'CatId' => $categoryId]);
        return $subCategoryNameExists;
    }

    /**
     * Deletes selected category
     * @param int $subCategoryId
     * @return boolean
     */
    public function deleteSubcategory($subCategoryId) {
        $subCategoryDeleted = false;
        $subCategoryRecord = $this->find()
                ->where(['SubCatId' => $subCategoryId])
                ->select()
                ->first();
        try {
            if ($subCategoryRecord) {
                $this->delete($subCategoryRecord);
                $subCategoryDeleted = true;
            }
        } catch (\Exception $exc) {
            \Cake\Log\Log::error($exc->getTraceAsString());
        }
        return $subCategoryDeleted;
    }

}
