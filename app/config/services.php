<?php

use Phalcon\Version;
use Phalcon\Mvc\View\Exception;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault;

$eventsManager = new EventsManager;

/**
 * We register the events manager
 */
$di->setShared('dispatcher', function () use ($di, $eventsManager) {
    /**
     * Check if the user is allowed to access certain action using the SecurityPlugin
     */
    $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

    /**
     * Handle exceptions and not-found exceptions using NotFoundPlugin
     */
    $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

    $dispatcher = new Dispatcher;
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlProvider;
    $url->setBaseUri($config->get('application')->baseUri);

    return $url;
});

/**
 * Setting the View and View Engines
 */
$di->setShared('view', function () use ($config, $di, $eventsManager) {
    $view = new View;

    $view->registerEngines(
        [
            '.volt'  => function ($view, $di) use ($config) {
                $volt = new Volt($view, $di);

                $options = [
                    'compiledPath'      => DOCROOT . $config->get('volt')->cacheDir,
                    'compiledExtension' => $config->get('volt')->compiledExt,
                    'compiledSeparator' => $config->get('volt')->separator,
                    'compileAlways'     => APP_STAGE !== APP_PRODUCTION,
                ];

                $volt->setOptions($options);

                $volt->getCompiler()
                    ->addFunction('strtotime',   'strtotime')
                    ->addFunction('sprintf',     'sprintf')
                    ->addFunction('str_replace', 'str_replace')
                    ->addFunction('is_a',        'is_a');

                return $volt;
            },
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
        ]
    );

    $view
        ->setVar('version', Version::get())
        ->setViewsDir(APP_PATH . $config->get('application')->viewsDir);

    $eventsManager->attach('view', function ($event, $view) use ($di, $config) {
        /**
         * @var \Phalcon\Events\Event $event
         * @var \Phalcon\Mvc\View $view
         */
        if ($event->getType() == 'notFoundView') {
            $message = sprintf('View not found - %s', $view->getActiveRenderPath());
            throw new Exception($message);
        }
    });

    $view->setEventsManager($eventsManager);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
    return new Mysql($config->get('database')->toArray());
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaData;
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter;
    $session->start();

    return $session;
});

/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function () {
    return new FlashSession(
        [
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]
    );
});

/**
 * Register a user component
 */
$di->set('elements', function () {
    return new Elements;
});
