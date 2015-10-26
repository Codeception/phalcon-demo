<?php

namespace PhalconDemo\Plugins\Acl;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;
use PhalconDemo\Plugins\Acl\Resource\ResourceInterface;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{
    /**
     * @var ResourceInterface
     */
    protected $resource;

    /**
     * Set resources
     *
     * @param ResourceInterface $resource
     * @return $this
     */
    public function setResources(ResourceInterface $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Returns an existing or new access control list
     *
     * @returns AclList
     */
    public function getAcl()
    {
        if (!$this->persistent->get('acl')) {
            $acl = new AclList;

            $acl->setDefaultAction(Acl::DENY);

            // Register roles
            $roles = [
                'users'  => new Role(
                    'Users',
                    'Member privileges, granted after sign in.'
                ),
                'guests' => new Role(
                    'Guests',
                    'Anyone browsing the site who is not signed in is considered to be a "Guest".'
                )
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            if ($this->resource instanceof ResourceInterface) {
                foreach ($this->resource->getAllResources() as $resource => $actions) {
                    $acl->addResource(new Resource($resource), $actions);
                }

                // Grant access to public areas to both users and guests
                foreach ($roles as $role) {
                    foreach ($this->resource->getPublicResources() as $resource => $actions) {
                        foreach ($actions as $action) {
                            $acl->allow($role->getName(), $resource, $action);
                        }
                    }
                }

                // Grant access to private area to role Users
                foreach ($this->resource->getPrivateResources() as $resource => $actions) {
                    foreach ($actions as $action) {
                        $acl->allow('Users', $resource, $action);
                    }
                }
            }

            // The acl is stored in session, APC would be useful here too
            $this->persistent->set('acl', $acl);
        }

        return $this->persistent->get('acl');
    }

    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        if (!$auth = $this->session->get('auth')) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isResource($controller)) {
            $dispatcher->forward(
                [
                    'controller' => 'errors',
                    'action'     => 'show404'
                ]
            );

            return false;
        }

        if (!$this->resource->hasAccess($controller, $action)) {
            $dispatcher->forward(
                [
                    'controller' => 'errors',
                    'action'     => 'show404'
                ]
            );

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);

        if ($allowed != Acl::ALLOW) {
            $dispatcher->forward(
                [
                    'controller' => 'errors',
                    'action'     => 'show401'
                ]
            );

            $this->session->destroy();
            return false;
        }
    }
}
