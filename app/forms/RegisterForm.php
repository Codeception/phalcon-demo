<?php

namespace PhalconDemo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class RegisterForm extends Form
{
    /**
     * Initialize the register form
     *
     * @param mixed $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = null)
    {
        // Name
        $name = new Text('name');
        $name->setLabel('Your Full Name');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([new PresenceOf(['message' => 'Name is required'])]);
        $this->add($name);

        // Login
        $name = new Text('username');
        $name->setLabel('Username');
        $name->setFilters(['alpha']);
        $name->addValidators([new PresenceOf(['message' => 'Please enter your desired user name'])]);
        $this->add($name);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf(['message' => 'E-mail is required']),
            new Email(['message' => 'E-mail is not valid'])
        ]);
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators([new PresenceOf(['message' => 'Password is required'])]);
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators([new PresenceOf(['message' => 'Confirmation password is required'])]);
        $this->add($repeatPassword);
    }
}
