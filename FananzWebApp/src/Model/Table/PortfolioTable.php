<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Portfolio Model
 *
 * @method \App\Model\Entity\Portfolio get($primaryKey, $options = [])
 * @method \App\Model\Entity\Portfolio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Portfolio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Portfolio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Portfolio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Portfolio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Portfolio findOrCreate($search, callable $callback = null)
 */
class PortfolioTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('portfolio');
        $this->displayField('PortfolioId');
        $this->primaryKey('PortfolioId');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('PortfolioId')
                ->allowEmpty('PortfolioId', 'create');

        $validator
                ->integer('CategoryId')
                ->requirePresence('CategoryId', 'create')
                ->notEmpty('CategoryId');

        $validator
                ->integer('SubcategoryId')
                ->allowEmpty('SubcategoryId');

        $validator
                ->allowEmpty('FacebookLink');

        $validator
                ->allowEmpty('YoutubeLink');

        $validator
                ->requirePresence('AboutPortfolio', 'create')
                ->notEmpty('AboutPortfolio');

        $validator
                ->numeric('MinPrice')
                ->allowEmpty('MinPrice');

        $validator
                ->numeric('MaxPrice')
                ->allowEmpty('MaxPrice');

        $validator
                ->integer('IsActive')
                ->requirePresence('IsActive', 'create')
                ->notEmpty('IsActive');

        return $validator;
    }

    public function getPortfolioList() {
        $this->addRelations();
        $portfolioList = null;
        $results = $this->find()
                ->contain(['subscribers', 'eventcategories', 'subcategories', 'portfolio_photos'])
                ->where(['Portfolio.IsActive' => 1, 'subscribers.IsSubscribed' => 1])
                ->select(['PortfolioId',
                    'subscribers.SubscriberName',
                    'CategoryId',
                    'eventcategories.CatName',
                    'SubcategoryId',
                    'subcategories.SubCatName',
                    'MinPrice',
                    'MaxPrice',
                    'subscribers.Nickname',
                    'subscribers.Stype',
                    'portfolio_photos.PhotoUrl'])
                ->all();
        //If no record found then return null
        if (!$results) {
            return null;
        }
        $recordCounter = 0;
        foreach ($results as $record => $recordKey) {
            $portfolioRecord = new \App\Dto\PortfolioListResponseDto();
            $portfolioRecord->portfolioId = $recordKey->PortfolioId;
            $portfolioRecord->categoryId = $recordKey->CategoryId;
            $portfolioRecord->category = $recordKey->eventcategory->CatName;
            $portfolioRecord->subcategory = $recordKey->subcategory->SubCatName;
            $portfolioRecord->subcategoryId = $recordKey->SubcategoryId;
            $portfolioRecord->minPrice = $recordKey->MinPrice;
            $portfolioRecord->maxPrice = $recordKey->MaxPrice;
            $nickName = $recordKey->subscriber->Nickname;
            $subscriberType = $recordKey->subscriber->Stype;
            //If the nickname is set and subscriber type is freelance
            if (isset($nickName) && $subscriberType == 'f') {
                $portfolioRecord->subscriberName = $nickName;
            } else {
                $portfolioRecord->subscriberName = $recordKey->subscriber->SubscriberName;
            }
            $portfolioRecord->coverImageUrl = $recordKey->portfolio_photo->PhotoUrl;
            
            $portfolioList[$recordCounter++] = $portfolioRecord;
        } //end of for

        return $portfolioList;
    }

    private function addRelations() {
        $this->belongsTo('subscribers', [
            'foreignKey' => 'SubscriberId',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('eventcategories', [
            'bindingKey' => 'CatId',
            'foreignKey' => 'CategoryId',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('subcategories', [
            'bindingKey' => 'SubCatId',
            'foreignKey' => 'SubcategoryId',
            'joinType' => 'LEFT'
        ]);

        $this->hasOne('portfolio_photos', [
            'foreignKey' => 'PortfolioId',
            'conditions' => ['portfolio_photos.IsCoverImage' => 1]
        ]);
    }

}
