<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscriber Entity
 *
 * @property int $SubscriberId
 * @property string $SubscriberName
 * @property string $BusinessContactPerson
 * @property string $EmailId
 * @property int $Stype
 * @property int $TelephoneNo
 * @property int $MobileNo
 * @property string $WebsiteUrl
 * @property string $CountryOfResidence
 * @property string $AboutUs
 * @property string $TradeCertificateUrl
 * @property int $IsSubscribed
 * @property \Cake\I18n\Time $SubscriptionDate
 * @property int $IsActive
 * @property string $Password
 * @property string $Nickname
 */
class Subscriber extends Entity
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
        'SubscriberId' => false
    ];
}
