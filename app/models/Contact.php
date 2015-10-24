<?php

namespace PhalconDemo\Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\RawValue;

/**
 * Contact Model
 *
 * @method static Contact findFirstById(int $id)
 */
class Contact extends Model
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
    public $email;

    /**
     * @var string
     */
    public $comments;

    /**
     * @var string
     */
    public $created_at;

    public function beforeCreate()
    {
        $this->created_at = new RawValue('NOW()');
    }
}
