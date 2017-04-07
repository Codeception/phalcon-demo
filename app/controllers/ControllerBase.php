<?php

namespace PhalconDemo\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->tag->prependTitle('Phalcon Demo Application | ');
        $this->view->setTemplateAfter('main');
    }

    public function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);

        return $this->dispatcher->forward(
            [
                'controller' => $uriParts[0],
                'action'     => $uriParts[1],
                'params'     => $params
            ]
        );
    }
}
