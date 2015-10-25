<?php

namespace PhalconDemo\Plugins;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{
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
                'users'  => new Role('Users'),
                'guests' => new Role('Guests')
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            // Private area resources
            $privateResources = [
                'companies'    => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
                'products'     => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
                'producttypes' => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
                'invoices'     => ['index'],
                'profile'      => ['edit']
            ];

            foreach ($privateResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            // Public area resources
            $publicResources = [
                'index'      => ['index'],
                'about'      => ['index'],
                'register'   => ['index'],
                'errors'     => ['show401', 'show404', 'show500'],
                'session'    => ['index', 'register', 'start', 'end'],
                'contact'    => ['index', 'send']
            ];

            foreach ($publicResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            //Grant access to public areas to both users and guests
            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    foreach ($actions as $action) {
                        $acl->allow($role->getName(), $resource, $action);
                    }
                }
            }

            // Grant access to private area to role Users
            foreach ($privateResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow('Users', $resource, $action);
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

        $allowed = $acl->isAllowed($role, $controller, $action);

        if ($allowed != Acl::ALLOW) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show401'
            ]);

            $this->session->destroy();
            return false;
        }
    }
}
