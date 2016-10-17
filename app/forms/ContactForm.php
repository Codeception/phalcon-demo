<?php

namespace PhalconDemo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class ContactForm extends Form
{
    /**
     * Initialize the contacts form
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

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf(['message' => 'E-mail is required']),
            new Email(['message' => 'E-mail is not valid'])
        ]);
        $this->add($email);

        $comments = new TextArea('comments');
        $comments->setLabel('Comments');
        $comments->setFilters(['striptags', 'string']);
        $comments->addValidators([new PresenceOf(['message' => 'Comments is required'])]);
        $this->add($comments);
    }
}
