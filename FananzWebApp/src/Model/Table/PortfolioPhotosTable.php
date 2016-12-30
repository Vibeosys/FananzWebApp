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
class PortfolioPhotosTable extends Table
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

        $this->table('portfolio_photos');
        $this->displayField('PhotoId');
        $this->primaryKey('PhotoId');
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
}
