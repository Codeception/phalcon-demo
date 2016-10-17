<?php

namespace PhalconDemo\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

/**
 * Users Model
 *
 * @method static Users findFirstById(int $id)
 */
class Users extends Model
{
    const STATUS_ACTIVE   = 'Y';
    const STATUS_INACTIVE = 'N';

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
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator([
                'model' => $this,
                'message' => 'Sorry, The email was registered by another user'
            ])
        );

        $validator->add(
            'username',
            new UniquenessValidator([
                'model' => $this,
                'message' => 'Sorry, That username is already taken',
            ])
        );

        return $this->validate($validator);
    }
}
