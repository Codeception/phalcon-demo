<?php

namespace PhalconDemo\Plugins;

use Phalcon\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;

/**
 * NotFoundPlugin
 *
 * Handles not-found controller/actions
 */
class NotFoundPlugin extends Plugin
{
    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param MvcDispatcher $dispatcher
     * @param \Exception $exception
     * @return boolean
     * @throws \Exception
     */
    public function beforeException(Event $event, MvcDispatcher $dispatcher, $exception)
    {
        if ($exception instanceof DispatcherException) {
            switch ($exception->getCode()) {
                case Dispatcher::EXCEPTION_INVALID_HANDLER:
                case Dispatcher::EXCEPTION_CYCLIC_ROUTING:
                    $action = 'show500';
                    break;
                case Dispatcher::EXCEPTION_INVALID_PARAMS:
                    $action = 'show400';
                    break;
                default:
                    $action = 'show404';
            }

            $dispatcher->forward(
                [
                    'controller' => 'errors',
                    'action'     => $action
                ]
            );

            return false;
        }

        if (APP_PRODUCTION !== APPLICATION_ENV && $exception instanceof \Exception) {
            throw $exception;
        }

        $dispatcher->forward(
            [
                'controller' => 'errors',
                'action'     => 'route500'
            ]
        );

        return $event->isStopped();
    }
}
