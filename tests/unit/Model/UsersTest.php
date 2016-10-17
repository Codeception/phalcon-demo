<?php

namespace App\Test\Unit\Models;

use UnitTester;
use Codeception\Test\Unit;
use PhalconDemo\Models\Users;

class UsersTest extends Unit
{
    /**
     * The Users model.
     * @var Users
     */
    protected $user;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->user = new Users;
    }

    public function testGetSource()
    {
        $this->assertEquals($this->user->getSource(), 'users');
    }
}
