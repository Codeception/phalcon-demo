<?php

namespace PhalconDemo\Controllers;

use Phalcon\Flash;
use Phalcon\Session;
use PhalconDemo\Models\Users;

class InvoicesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your Invoices');
        parent::initialize();
    }

    public function indexAction()
    {
    }

    /**
     * Edit the active user profile
     */
    public function profileAction()
    {
        // Get session info
        $auth = $this->session->get('auth');

        /** @var Users $user */
        $user = Users::findFirst($auth['id']);

        if ($user == false) {
            return $this->forward('index/index');
        }

        if (!$this->request->isPost()) {
            $this->tag->setDefault('name', $user->name);
            $this->tag->setDefault('email', $user->email);
        } else {
            $name = $this->request->getPost('name', array('string', 'striptags'));
            $email = $this->request->getPost('email', 'email');

            $user->name = $name;
            $user->email = $email;
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('Your profile information was updated successfully');
            }
        }
    }
}
