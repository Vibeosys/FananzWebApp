<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Portfolio Entity
 *
 * @property int $PortfolioId
 * @property int $CategoryId
 * @property int $SubcategoryId
 * @property string $FacebookLink
 * @property string $YoutubeLink
 * @property string $AboutPortfolio
 * @property float $MinPrice
 * @property float $MaxPrice
 * @property int $SubscriberId 
 * @property int $IsActive
 * @property \Cake\I18n\Time $CreatedDate 
 */
class Portfolio extends Entity
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
        'PortfolioId' => false
    ];
}
