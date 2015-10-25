<?php

return [
    '/' => [
        'params' => [
            'controller' => 'index',
            'action'     => 'index'
        ],
        'name' => 'front.index'
    ],

    '/:controller' => [
        'params' => [
            'controller' => 1,
            'action'     => 'index'
        ],
        'name' => 'front.controller'
    ],

    '/contact-us' => [
        'params' => [
            'controller' => 'contact',
            'action'     => 'index'
        ],
        'name' => 'front.contact'
    ],

    '/:controller/:action/:params' => [
        'params' => [
            'controller' => 1,
            'action'     => 2,
            'params'     => 3
        ],
        'name' => 'front.full'
    ],
];