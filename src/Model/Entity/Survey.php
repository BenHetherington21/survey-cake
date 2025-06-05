<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Survey Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property int $visibility
 * @property \Cake\I18n\DateTime $creation_date
 * @property \Cake\I18n\DateTime $completion_date
 * @property string $code
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Question[] $questions
 * @property \App\Model\Entity\Response[] $responses
 */
class Survey extends Entity
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
        'title' => true,
        'description' => true,
        'status' => true,
        'visibility' => true,
        'creation_date' => true,
        'completion_date' => true,
        'code' => true,
        'user' => true,
        'questions' => true,
        'responses' => true,
    ];
}
