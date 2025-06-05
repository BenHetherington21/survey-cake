<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SurveysFixture
 */
class SurveysFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor ',
                'visibility' => 1,
                'creation_date' => '2025-06-05 08:37:10',
                'completion_date' => '2025-06-05 08:37:10',
                'code' => 'Lorem ',
            ],
        ];
        parent::init();
    }
}
