<?php

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;

try {
    require_once realpath(dirname(dirname(__FILE__))) . '/app/config/env.php';

    /**
     * Read the configuration
     */
    $config = new ConfigIni(APP_PATH . 'config/config.ini');
    if (is_readable(APP_PATH . 'config/config.ini.dev')) {
        $override = new ConfigIni(APP_PATH . 'config/config.ini.dev');
        $config->merge($override);
    }

    /**
     * Auto-loader configuration
     */
    require APP_PATH . 'config/loader.php';

    /**
     * Load application services
     */
    require APP_PATH . 'config/services.php';

    $application = new Application($di);
    $application->setEventsManager($eventsManager);

    if (APPLICATION_ENV == APP_TEST) {
        return $application;
    } else {
        echo $application->handle()->getContent();
    }
} catch (Exception $e){
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
