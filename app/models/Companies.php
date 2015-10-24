<?php

namespace PhalconDemo\Models;

use Phalcon\Mvc\Model;

/**
 * Companies Model
 *
 * @method static Companies findFirstById(int $id)
 */
class Companies extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $telephone;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $city;
}
