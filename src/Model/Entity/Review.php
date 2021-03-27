<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property int $id
 * @property string $text
 * @property int|null $voting
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $user_id
 * @property int $clinic_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Clinic $clinic
 */
class Review extends Entity
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
        'text' => true,
        'voting' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'clinic_id' => true,
        'user' => true,
        'clinic' => true,
    ];
}
