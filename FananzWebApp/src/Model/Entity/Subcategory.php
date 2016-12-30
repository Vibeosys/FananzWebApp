<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subcategory Entity
 *
 * @property int $SubCatId
 * @property string $SubCatName
 * @property string $SubCatShortName
 * @property int $CatId
 * @property int $IsActive
 * @property \Cake\I18n\Time $DateCreated
 */
class Subcategory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'SubCatId' => false
    ];
}
