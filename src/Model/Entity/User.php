<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $gender
 * @property int $age
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $disease_categorie_id
 * @property string $email
 *
 * @property \App\Model\Entity\DiseaseCategory $disease_category
 * @property \App\Model\Entity\Review[] $reviews
 */
class User extends Entity
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
        'id' => false,
        'username' => true,
	'avatar' => true,
        'password' => true,
        'gender' => true,
        'age' => true,
        'created' => true,
        'modified' => true,
        'disease_categorie_id' => true,
        'email' => true,
        'disease_category' => true,
        'reviews' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
