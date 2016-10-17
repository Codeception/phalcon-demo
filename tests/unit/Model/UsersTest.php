<?php

namespace App\Test\Unit\Models;

use Codeception\Test\Unit;
use PhalconDemo\Models\Users;

class UsersTest extends Unit
{
    /**
     * The Users model.
     * @var Users
     */
    protected $user;

    protected function _before()
    {
        $this->user = new Users;
    }

    public function testGetSource()
    {
        $this->assertEquals($this->user->getSource(), 'users');
    }
}
