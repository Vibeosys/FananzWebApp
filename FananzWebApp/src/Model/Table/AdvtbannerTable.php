<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Advtbanner Model
 *
 * @method \App\Model\Entity\Advtbanner get($primaryKey, $options = [])
 * @method \App\Model\Entity\Advtbanner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Advtbanner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Advtbanner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Advtbanner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Advtbanner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Advtbanner findOrCreate($search, callable $callback = null, $options = [])
 */
class AdvtbannerTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('advtbanner');
        $this->displayField('BannerId');
        $this->primaryKey('BannerId');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('BannerId')
                ->allowEmpty('BannerId', 'create');

        $validator
                ->integer('BannerType')
                ->requirePresence('BannerType', 'create')
                ->notEmpty('BannerType');

        $validator
                ->allowEmpty('BannerPicUrl');

        $validator
                ->allowEmpty('BannerRedirectUrl');

        $validator
                ->dateTime('DateCreated')
                ->requirePresence('DateCreated', 'create')
                ->notEmpty('DateCreated');

        return $validator;
    }

    /**
     * Saves data for banner
     * @param \App\Dto\AdvtBannerSaveRequestDto $advtBannerSaveRequest
     * @return boolean
     */
    public function addOrUpdateNewBanner($advtBannerSaveRequest) {
        $saveSuccess = false;
        //Find if there exist a record for provided information
        $dbBannerRecord = $this->find()
                ->where(['BannerType' => $advtBannerSaveRequest->bannerLocation])
                ->select(['BannerId', 'BannerPicUrl', 'BannerRedirectUrl'])
                ->first();

        //If no data found then create new object
        if (!$dbBannerRecord) {
            //else create new record in DB
            $dbBannerRecord = $this->newEntity();
        }
        
        $dbBannerRecord->BannerType = $advtBannerSaveRequest->bannerLocation;
        $dbBannerRecord->BannerPicUrl = $advtBannerSaveRequest->bannerImageUrl;
        $dbBannerRecord->BannerRedirectUrl = $advtBannerSaveRequest->bannerClickUrl;
        if ($this->save($dbBannerRecord)) {
            $saveSuccess = true;
        }
        return $saveSuccess;
    }

    public function deleteBanner($bannerLocation) {
        $deleteSuccess = false;
        $dbBanner = $this->find()
                ->where(['BannerType' => $bannerLocation])
                ->select(['BannerId'])
                ->first();

        if ($dbBanner) {
            if ($this->delete($dbBanner)) {
                $deleteSuccess = true;
            }
        }
        return $deleteSuccess;
    }

    /**
     * Gets the details for the banner location
     * @param type $bannerLocation
     * @return \App\Dto\BannerDetailsResponseDto
     */
    public function getDetails($bannerLocation) {
        $bannerDetails = null;
        $dbBanner = $this->find()
                ->where(['BannerType' => $bannerLocation])
                ->select(['BannerId', 'BannerPicUrl', 'BannerRedirectUrl'])
                ->first();
        if ($dbBanner) {
            $bannerDetails = new \App\Dto\BannerDetailsResponseDto();
            $bannerDetails->bannerId = $dbBanner->BannerId;
            $bannerDetails->imageUrl = $dbBanner->BannerPicUrl;
            $bannerDetails->clickUrl = $dbBanner->BannerRedirectUrl;
        }

        return $bannerDetails;
    }

}
