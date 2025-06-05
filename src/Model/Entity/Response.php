<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Response Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $survey_id
 * @property string $type
 * @property string $data
 * @property \Cake\I18n\DateTime $time
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Survey $survey
 */
class Response extends Entity
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
        'user_id' => true,
        'survey_id' => true,
        'type' => true,
        'data' => true,
        'time' => true,
        'user' => true,
        'survey' => true,
    ];
}
