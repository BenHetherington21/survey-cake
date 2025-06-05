<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property int $id
 * @property int $survey_id
 * @property string $title
 * @property string $type
 * @property string|null $options
 * @property int $position
 * @property bool $required
 *
 * @property \App\Model\Entity\Survey $survey
 */
class Question extends Entity
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
        'survey_id' => true,
        'title' => true,
        'type' => true,
        'options' => true,
        'position' => true,
        'required' => true,
        'survey' => true,
    ];
}
