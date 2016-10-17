<?php

namespace PhalconDemo\Controllers;

use PhalconDemo\Forms\ContactForm;
use PhalconDemo\Models\Contact;

/**
 * ContactController
 *
 * Allows to contact the staff using a contact form
 */
class ContactController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Contact us');

        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->setVar('form', new ContactForm);
    }

    /**
     * Saves the contact information in the database
     */
    public function sendAction()
    {
        if ($this->request->isPost() != true) {
            return $this->forward('contact/index');
        }

        $form = new ContactForm;
        $contact = new Contact;

        // Validate the form
        $data = $this->request->getPost();
        if (!$form->isValid($data, $contact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('contact/index');
        }

        if ($contact->save() == false) {
            foreach ($contact->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('contact/index');
        }

        $this->flash->success('Thanks, we will contact you in the next few hours');

        return $this->forward('index/index');
    }
}
