<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $user_id
 * @property string $user_email
 * @property string $user_password
 * @property string $user_firstname
 * @property string $user_surname
 * @property string $user_type
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
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_email' => true,
        'user_password' => true,
        'user_firstname' => true,
        'user_surname' => true,
        'user_type' => true,
    ];
}
