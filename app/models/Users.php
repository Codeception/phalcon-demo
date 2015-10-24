<?php

namespace PhalconDemo\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

/**
 * Users Model
 *
 * @method static Users findFirstById(int $id)
 */
class Users extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

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
    public $created_at;

    /**
     * @var string
     */
    public $active;

    public function validation()
    {
        $this->validate(new EmailValidator([
            'field' => 'email'
        ]));
        $this->validate(new UniquenessValidator([
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        ]));
        $this->validate(new UniquenessValidator([
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        ]));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
