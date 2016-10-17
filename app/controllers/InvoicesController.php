<?php

namespace PhalconDemo\Controllers;

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
}
