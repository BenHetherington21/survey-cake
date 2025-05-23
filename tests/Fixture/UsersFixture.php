<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'user_id' => 1,
                'user_email' => 'Lorem ipsum dolor sit amet',
                'user_password' => 'Lorem ipsum dolor sit amet',
                'user_firstname' => 'Lorem ipsum dolor sit amet',
                'user_surname' => 'Lorem ipsum dolor sit amet',
                'user_type' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
