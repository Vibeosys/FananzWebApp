<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Advtbanner Entity
 *
 * @property int $BannerId
 * @property int $BannerType
 * @property string $BannerPicUrl
 * @property string $BannerRedirectUrl
 * @property \Cake\I18n\Time $DateCreated
 */
class Advtbanner extends Entity
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
        'BannerId' => false
    ];
}
