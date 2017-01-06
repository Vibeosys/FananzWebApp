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
        $dbPhoto = $this->find()
                ->where(['PhotoId' => $photoId, 'IsCoverImage' => 0])
                ->first();
        if ($dbPhoto) {
            if ($this->delete($dbPhoto)) {
                return true;
            }
        }
        return FALSE;
    }

}
