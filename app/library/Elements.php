<?php

namespace PhalconDemo\Library;

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
    private $headerMenu = [
        'navbar-left' => [
            'index' => [
                'caption' => 'Home',
                'action' => 'index'
            ],
            'invoices' => [
                'caption' => 'Invoices',
                'action' => 'index'
            ],
            'about' => [
                'caption' => 'About',
                'action' => 'index'
            ],
            'contact' => [
                'caption' => 'Contact',
                'action' => 'index'
            ],
        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Log In/Sign Up',
                'action' => 'index'
            ],
        ]
    ];

    private $tabs = [
        'Invoices' => [
            'controller' => 'invoices',
            'action' => 'index',
            'any' => false
        ],
        'Companies' => [
            'controller' => 'companies',
            'action' => 'index',
            'any' => true
        ],
        'Products' => [
            'controller' => 'products',
            'action' => 'index',
            'any' => true
        ],
        'Product Types' => [
            'controller' => 'producttypes',
            'action' => 'index',
            'any' => true
        ]
    ];

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {
        $auth = $this->session->get('auth');
        if (isset($auth['id'])) {
            $this->headerMenu['navbar-right'] = [
                'profile' => [
                    'caption' => 'Profile',
                    'action'  => 'edit'
                ],
                'session' => [
                    'caption' => 'Log Out',
                    'action' => 'end'
                ]
            ];
        } else {
            unset($this->headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }

                $link = $controller . '/' . $option['action'];

                if (isset($option['params'])) {
                    $link .= '/' . $option['params'];
                }

                echo $this->tag->linkTo($link, $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }
}
