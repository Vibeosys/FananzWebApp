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

    private function getTable() {
        return \Cake\ORM\TableRegistry::get('portfolio');
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

    /**
     * Update portfolio with given parameters
     * @param \App\Dto\PortfolioUpdateRequestDto $portfolioUpdateRequest
     * @return boolean
     */
    public function updatePortfolio($portfolioUpdateRequest) {
        $dbPortfolio = $this->find()
                ->where(['PortfolioId' => $portfolioUpdateRequest->portfolioId])
                ->first();
        //If the portfolio is found and gets updated then return true else false
        if ($dbPortfolio) {
            $dbPortfolio->CategoryId = $portfolioUpdateRequest->categoryId;
            if ($portfolioUpdateRequest->subCategoryId == 0) {
                $dbPortfolio->SubcategoryId = NULL;
            }
            $dbPortfolio->FacebookLink = $portfolioUpdateRequest->fbLink;
            $dbPortfolio->YoutubeLink = $portfolioUpdateRequest->youtubeLink;
            $dbPortfolio->AboutPortfolio = $portfolioUpdateRequest->aboutUs;
            $dbPortfolio->MinPrice = $portfolioUpdateRequest->minPrice;
            $dbPortfolio->MaxPrice = $portfolioUpdateRequest->maxPrice;
            if (isset($portfolioUpdateRequest->isActive)) {
                $dbPortfolio->IsActive = $portfolioUpdateRequest->isActive;
            }
            if ($this->save($dbPortfolio)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Set active or inactive for the portfolio
     * @param int $portfolioId
     * @param int $isActive
     * @return boolean
     */
    public function inactivatePortfolio($portfolioId, $isActive) {
        $dbPortfolio = $this->find()
                ->where(['PortfolioId' => $portfolioId])
                ->select(['IsActive', 'PortfolioId'])
                ->first();
        if ($dbPortfolio) {
            $dbPortfolio->IsActive = $isActive;
            if ($this->save($dbPortfolio)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Gets portfolio details by id
     * @param int $portfolioId
     * @return \App\Dto\PortfolioEmailDetailsDto $requestedPortfolioDetails
     */
    public function getPortfolioDetailsById($portfolioId) {
        $thisTable = $this->getTable();
        $this->addTableRelations();
        //$this->getTable()->addRelationsForPortfolio();
        $requestedPortfolioDetails = NULL;
        $results = $thisTable->find()
                ->contain(['subscribers', 'eventcategories', 'subcategories', 'portfolio_photos'])
                ->where(['portfolio.IsActive' => 1,
                    'subscribers.IsSubscribed' => 1,
                    'portfolio.PortfolioId' => $portfolioId])
                ->select([
                    'subscribers.EmailId',
                    'subscribers.MobileNo',
                    'subscribers.SubscriberName',
                    'subscribers.Nickname',
                    'subscribers.Stype',
                    'subscribers.BusinessContactPerson',
                    'portfolio.SubscriberId',
                    'eventcategories.CatName',
                    'subcategories.SubCatName',
                    'MinPrice',
                    'MaxPrice',
                    'portfolio_photos.PhotoUrl'])
                ->all();
        $resultsArray = $results->toArray();
        foreach ($resultsArray as $resultRecord) {
            $requestedPortfolioDetails = new \App\Dto\PortfolioEmailDetailsDto();
            $requestedPortfolioDetails->category = $resultRecord->eventcategory->CatName;
            $requestedPortfolioDetails->subcategory = $resultRecord->subcategory->SubCatName;
            $requestedPortfolioDetails->minPrice = $resultRecord->MinPrice;
            $requestedPortfolioDetails->maxPrice = $resultRecord->MaxPrice;
            $requestedPortfolioDetails->subscriberId = $resultRecord->SubscriberId;
            $requestedPortfolioDetails->subscriberPhone = $resultRecord->subscriber->MobileNo;
            $requestedPortfolioDetails->subscriberEmail = $resultRecord->subscriber->EmailId;
            $requestedPortfolioDetails->contactPerson = $resultRecord->subscriber->BusinessContactPerson;
            $requestedPortfolioDetails->coverImageUrl = $resultRecord->portfolio_photo->PhotoUrl;

            //set local variables
            $nickName = $resultRecord->subscriber->Nickname;
            $subscriberType = $resultRecord->subscriber->Stype;

            if ($subscriberType == FREELANCE_SUB_TYPE) {
                $requestedPortfolioDetails->subscriberType = "Freelancer";
                $requestedPortfolioDetails->subscriberName = $nickName;
            } else {
                $requestedPortfolioDetails->subscriberType = "Corporate";
                $requestedPortfolioDetails->subscriberName = $resultRecord->subscriber->SubscriberName;
            }
        }

        return $requestedPortfolioDetails;
    }

    /**
     * Gets portfolio details for given portfolio data
     * @param \App\Dto\PortfolioDetailRequestDto $portfolioData
     * @return \App\Dto\PortfolioDetailsResponseDto $portfolioDetailsResponse
     */
    public function getPortfolioDetails($portfolioData) {
        $this->addRelationsForPortfolio();
        $portfolioDetailsResponse = NULL;
        $results = $this->find()
                ->contain(['subscribers', 'eventcategories', 'subcategories', 'portfolio_photos'])
                ->where(['Portfolio.IsActive' => 1,
                    'subscribers.IsSubscribed' => 1,
                    'Portfolio.PortfolioId' => $portfolioData->portfolioId])
                ->select(['PortfolioId',
                    'subscribers.SubscriberName',
                    'Portfolio.SubscriberId',
                    'CategoryId',
                    'eventcategories.CatName',
                    'SubcategoryId',
                    'subcategories.SubCatName',
                    'MinPrice',
                    'MaxPrice',
                    'FacebookLink',
                    'YoutubeLink',
                    'AboutPortfolio',
                    'subscribers.Nickname',
                    'subscribers.Stype'])
                ->all();
        $resultsArray = $results->toArray();
        foreach ($resultsArray as $resultRecord) {
            $portfolioDetailsResponse = new \App\Dto\PortfolioDetailsResponseDto();
            $portfolioDetailsResponse->aboutUs = $resultRecord->AboutPortfolio;
            $portfolioDetailsResponse->portfolioId = $resultRecord->PortfolioId;
            $portfolioDetailsResponse->category = $resultRecord->eventcategory->CatName;
            $portfolioDetailsResponse->subCategory = $resultRecord->subcategory->SubCatName;
            $portfolioDetailsResponse->categoryId = $resultRecord->CategoryId;
            $portfolioDetailsResponse->subCategoryId = $resultRecord->SubcategoryId;
            $portfolioDetailsResponse->minPrice = $resultRecord->MinPrice;
            $portfolioDetailsResponse->maxPrice = $resultRecord->MaxPrice;
            $portfolioDetailsResponse->subscriberId = $resultRecord->SubscriberId;
            $portfolioDetailsResponse->fbLink = $resultRecord->FacebookLink;
            $portfolioDetailsResponse->youtubeLink = $resultRecord->YoutubeLink;
            //set local variables
            $nickName = $resultRecord->subscriber->Nickname;
            $subscriberType = $resultRecord->subscriber->Stype;

            if (isset($nickName) && $subscriberType == 'f') {
                $portfolioDetailsResponse->subscriberName = $nickName;
            } else {
                $portfolioDetailsResponse->subscriberName = $resultRecord->subscriber->SubscriberName;
            }
            $photoRecordCounter = 0;
            //Add phototos to array
            foreach ($resultRecord->portfolio_photos as $photoRecord) {
                if ($photoRecord->IsCoverImage == 1) {
                    $portfolioDetailsResponse->coverImageUrl = $photoRecord->PhotoUrl;
                } else {
                    $portfolioDetailsResponse->photos[$photoRecordCounter++] = $photoRecord->PhotoUrl;
                    ;
                }
            } // End of for photos
        }

        return $portfolioDetailsResponse;
    }

    /**
     * Adds new portfolio for subscriber
     * @param \App\Dto\PortfolioAdditionDto $portfolioAddition
     * @param int $subscriberId
     */
    public function addPortfolio($portfolioAddition, $subscriberId) {
        $portfolioNew = $this->newEntity();
        $portfolioNew->SubscriberId = $subscriberId;
        $portfolioNew->CategoryId = $portfolioAddition->categoryId;
        //In case of subcategory is 0 instead of NULL then take care
        if ($portfolioAddition->subCategoryId != 0) {
            $portfolioNew->SubcategoryId = $portfolioAddition->subCategoryId;
        }
        $portfolioNew->FacebookLink = $portfolioAddition->fbLink;
        $portfolioNew->YoutubeLink = $portfolioAddition->youtubeLink;
        $portfolioNew->MinPrice = $portfolioAddition->minPrice;
        $portfolioNew->MaxPrice = $portfolioAddition->maxPrice;
        $portfolioNew->AboutPortfolio = $portfolioAddition->aboutUs;
        $portfolioNew->IsActive = 1;
        $portfolioNew->CreatedDate = new \Cake\I18n\Time();

        if ($this->save($portfolioNew)) {
            return $portfolioNew->PortfolioId;
        } else {
            return 0;
        }
    }

    /**
     * Get list of portfolios by subscriber Id, provided that subscriber is subscribed
     * @param int $subscriberId
     * @return \App\Dto\SubscriberPortfolioListResponseDto[] 
     */
    public function getPortfoliosBySubscriber($subscriberId) {
        $this->addRelations();
        $portfolioList = null;
        $results = $this->find()
                ->contain(['subscribers', 'eventcategories', 'subcategories', 'portfolio_photos'])
                ->where(['subscribers.IsSubscribed' => 1,
                    'Portfolio.SubscriberId' => $subscriberId])
                ->select(['PortfolioId',
                    'eventcategories.CatName',
                    'subcategories.SubCatName',
                    'MinPrice',
                    'MaxPrice',
                    'portfolio_photos.PhotoUrl'])
                ->orderDesc('Portfolio.CreatedDate')
                ->all();

        $resultArray = $results->toArray();
        $recordCounter = 0;
        foreach ($resultArray as $resultRecord) {
            $subscriberPortfolioResponse = new \App\Dto\SubscriberPortfolioListResponseDto();
            $subscriberPortfolioResponse->portfolioId = $resultRecord->PortfolioId;
            $subscriberPortfolioResponse->category = $resultRecord->eventcategory->CatName;
            $subscriberPortfolioResponse->subCategory = $resultRecord->subcategory->SubCatName;
            $subscriberPortfolioResponse->minPrice = $resultRecord->MinPrice;
            $subscriberPortfolioResponse->maxPrice = $resultRecord->MaxPrice;
            $subscriberPortfolioResponse->coverImageUrl = $resultRecord->portfolio_photo->PhotoUrl;
            $portfolioList[$recordCounter++] = $subscriberPortfolioResponse;
        }
        return $portfolioList;
    }

    /**
     * Gets all the portfolio from Fananz
     * @return \App\Dto\PortfolioListResponseDto[] $portfolioList
     */
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
                ->orderDesc('Portfolio.CreatedDate')
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

    private function addTableRelations() {
        $this->getTable()->belongsTo('subscribers', [
            'foreignKey' => 'SubscriberId',
            'joinType' => 'INNER'
        ]);

        $this->getTable()->belongsTo('eventcategories', [
            'bindingKey' => 'CatId',
            'foreignKey' => 'CategoryId',
            'joinType' => 'INNER'
        ]);

        $this->getTable()->belongsTo('subcategories', [
            'bindingKey' => 'SubCatId',
            'foreignKey' => 'SubcategoryId',
            'joinType' => 'LEFT'
        ]);

        $this->getTable()->hasOne('portfolio_photos', [
            'foreignKey' => 'PortfolioId',
            'conditions' => ['portfolio_photos.IsCoverImage' => 1]
        ]);
    }

    private function addRelationsForPortfolio() {
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

        $this->hasMany('portfolio_photos', [
            'foreignKey' => 'PortfolioId',
            'className' => 'PortfolioPhotos'
        ]);
    }

}
