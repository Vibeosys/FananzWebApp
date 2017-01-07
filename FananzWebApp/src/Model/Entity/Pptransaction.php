<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pptransaction Entity
 *
 * @property string $TransId
 * @property string $PaypalTransId
 * @property int $PaymentStatus
 * @property int $SubscriberId
 * @property string $Currency
 * @property float $Amount
 * @property \Cake\I18n\Time $CompletionDate
 * @property string $AccessToken
 */
class Pptransaction extends Entity
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
        'TransId' => false
    ];
}
