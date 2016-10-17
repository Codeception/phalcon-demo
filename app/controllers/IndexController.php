<?php

namespace PhalconDemo\Controllers;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome');

        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->notice(
                'This is a Phalcon Demo Application. ' .
                "Please don't provide us any personal information. Thanks!"
            );
        }
    }
}
