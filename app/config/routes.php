<?php
/**
 * @var \Phalcon\Events\Manager $eventsManager
 */

use Phalcon\Mvc\Router;

$router = new Router();

$router->removeExtraSlashes(true);

if (!isset($_GET['_url'])) {
    $router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);
}

$router->setEventsManager($eventsManager);

$router->add('/:controller', [
    'controller' => 1,
    'action'     => 'index'
])->setName('front.controller');

$router->add('/contact-us', [
    'controller' => 'contact',
    'action'     => 'index'
])->setName('front.contact');

$router->add('/login', [
    'controller' => 'session',
    'action'     => 'index'
])->setName('login.route');

$route = $router->add('/signin', [
    'controller' => 'session',
    'action'     => 'index'
]);

$route->setName('domain.route');
$route->setHostName('join.phalcon.demo');

$router->add('/profile/edit', [
    'controller' => 'profile',
    'action'     => 'edit'
])->setName('profile.edit');

$router->add('/:controller/:action/:params', [
    'controller' => 1,
    'action'     => 2,
    'params'     => 3,
])->setName('front.full');

return $router;
