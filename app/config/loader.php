<?php
/**
 * We're a registering a set of directories taken from the configuration file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Loader;

$loader = new Loader;

$loader->registerNamespaces(
    [
        'PhalconDemo\Controllers' => APP_PATH . $config->get('application')->controllersDir,
        'PhalconDemo\Forms'       => APP_PATH . $config->get('application')->formsDir,
        'PhalconDemo\Models'      => APP_PATH . $config->get('application')->modelsDir,
        'PhalconDemo\Plugins'     => APP_PATH . $config->get('application')->pluginsDir,
        'PhalconDemo\Library'     => APP_PATH . $config->get('application')->libraryDir
    ]
);

$loader->register();

