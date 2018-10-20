<?php
/**
 * Created by PhpStorm.
 * User: fenikkusu
 * Date: 2018-10-18
 * Time: 23:34
 */

namespace User\Functional;

use Codeception\Lib\Connector\Phalcon\MemorySession;

class Session extends MemorySession
{
    public function getTrue()
    {
        return true;
    }
}