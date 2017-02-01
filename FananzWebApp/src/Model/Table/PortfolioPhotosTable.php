<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PortfolioPhotos Model
 *
 * @method \App\Model\Entity\PortfolioPhoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\PortfolioPhoto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PortfolioPhoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PortfolioPhoto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PortfolioPhoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PortfolioPhoto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PortfolioPhoto findOrCreate($search, callable $callback = null)
 */
class PortfolioPhotosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('portfolio_photos');
        $this->displayField('PhotoId');
        $this->primaryKey('PhotoId');
        $this->belongsTo('portfolio', [
            'foreignKey' => 'PortfolioId'
        ]);
    }

    private function getTable() {
        return \Cake\ORM\TableRegistry::get('portfolio_photos');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('PhotoId')
                ->allowEmpty('PhotoId', 'create');

        $validator
                ->allowEmpty('PhotoUrl');

        $validator
                ->integer('IsCoverImage')
                ->allowEmpty('IsCoverImage');

        $validator
                ->integer('PortfolioId')
                ->requirePresence('PortfolioId', 'create')
                ->notEmpty('PortfolioId');

        return $validator;
    }

    /**
     * Adds subscriber photo to database
     * @param int $portfolioId
     * @param string $imagePath
     * @param bool $isCoverImage
     * @return int
     */
    public function addSubscriberPhoto($portfolioId, $imagePath, $isCoverImage) {
        $subscriberPhoto = $this->newEntity();
        $subscriberPhoto->PortfolioId = $portfolioId;
        $subscriberPhoto->PhotoUrl = $imagePath;
        $subscriberPhoto->IsCoverImage = $isCoverImage;
        if ($this->save($subscriberPhoto)) {
            return $subscriberPhoto->PhotoId;
        }
        return 0;
    }

    public function addImage($portfolioId, $imagePath, $isCoverImage) {
        $subscriberPhoto = $this->getTable()->newEntity();
        $subscriberPhoto->PortfolioId = $portfolioId;
        $subscriberPhoto->PhotoUrl = $imagePath;
        $subscriberPhoto->IsCoverImage = $isCoverImage;
        if ($this->getTable()->save($subscriberPhoto)) {
            return $subscriberPhoto->PhotoId;
        }
        return 0;
    }

    /**
     * Gets list of photos for given portfolio
     * @param int $portfolioId
     * @return \App\Dto\ServerImageResponseDto[]
     */
    public function getPhotos($portfolioId) {
        $serverImageList = null;
        $imageCounter = 0;
        $result = $this->find()
                ->where(['PortfolioId' => $portfolioId])
                ->all();

        $imageArray = $result->toArray();
        foreach ($imageArray as $dbImage) {
            $serverImage = new \App\Dto\ServerImageResponseDto();
            $serverImage->photoId = $dbImage->PhotoId;
            $serverImage->photoUrl = $dbImage->PhotoUrl;
            $serverImage->isCoverImage = $dbImage->IsCoverImage;
            $serverImageList[$imageCounter++] = $serverImage;
        }

        return $serverImageList;
    }

    /**
     * Add or update photos
     * @param \App\Dto\ServerImageResponseDto $serverImages
     */
    public function addOrdUpdatePhotos($serverImages, $portfolioId) {
        $imagesAddedOrUpdated = true;
        foreach ($serverImages as $serverImage) {
            //If the image is cover image then next
            if ($serverImage->photoId == -1) {
                $dbCoverImage = $this->getTable()->find()
                        ->where(['PortfolioId' => $portfolioId, 'IsCoverImage' => 1])
                        ->select(['PhotoId', 'PhotoUrl'])
                        ->first();
                if ($dbCoverImage) {
                    $dbCoverImage->PhotoUrl = $serverImage->photoUrl;
                    if ($this->getTable()->save($dbCoverImage)) {
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & true;
                    } else {
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & false;
                    }
                } else {
                    $result = $this->addImage($portfolioId, $serverImage->photoUrl, 1);
                    if ($result > 0) {
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & true;
                    }
                    else{
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & false;
                    }
                }
                //If the image is not cover image then
            } else {
                $dbImage = $this->getTable()->find()
                        ->where(['PortfolioId' => $portfolioId, 'PhotoId' => $serverImage->photoId])
                        ->select(['PhotoId', 'PhotoUrl', 'IsCoverImage'])
                        ->first();
                if ($dbImage) {
                    $dbImage->PhotoUrl = $serverImage->photoUrl;
                    $dbImage->IsCoverImage = 0;
                    if ($this->getTable()->save($dbImage)) {
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & true;
                    } else {
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & false;
                    }
                } else {
                    $result = $this->addImage($portfolioId, $serverImage->photoUrl, 0);
                    if ($result > 0) {
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & true;
                    }
                    else{
                        $imagesAddedOrUpdated = $imagesAddedOrUpdated & false;
                    }
                }
            }
        }

        return $imagesAddedOrUpdated;
    }

    /**
     * Updates photo url for given photo
     * @param int $photoId
     * @param string $photoUrl
     * @return boolean
     */
    public function updatePhoto($photoId, $photoUrl) {
        $dbPhoto = $this->find()
                ->where(['PhotoId' => $photoId])
                ->first();
        if ($dbPhoto) {
            $dbPhoto->PhotoUrl = $photoUrl;
            if ($this->save($dbPhoto)) {
                return true;
            }
        }
        return FALSE;
    }

    /**
     * Deletes requested photo
     * @param int $photoId
     * @return boolean
     */
    public function deletePhoto($photoId) {
        $dbPhoto = $this->getTable()->find()
                ->where(['PhotoId' => $photoId, 'IsCoverImage' => 0])
                ->first();
        if ($dbPhoto) {
            if ($this->getTable()->delete($dbPhoto)) {
                return true;
            }
        }
        return FALSE;
    }

    /**
     * Adds portfolio photos in batch
     * @param \App\Dto\ServerImageResponseDto $serverPhotos
     * @param int $portfolioId
     * @return boolean
     */
    public function addPortfolioPhotos($serverPhotos, $portfolioId) {
        $portfolioPhotoEntities = [];
        foreach ($serverPhotos as $portfolioPhoto) {
            $subscriberPhoto = $this->getTable()->newEntity();
            $subscriberPhoto->PortfolioId = $portfolioId;
            $subscriberPhoto->PhotoUrl = $portfolioPhoto->photoUrl;
            $subscriberPhoto->IsCoverImage = $portfolioPhoto->isCoverImage;
            array_push($portfolioPhotoEntities, $subscriberPhoto);
        }
        if ($this->getTable()->saveMany($portfolioPhotoEntities)) {
            return true;
        }
    }

}
