<?php
/**
 * We're a registering a set of directories taken from the configuration file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Loader;

$loader = new Loader;

$loader->registerDirs(
    [
        APP_PATH . $config->get('application')->controllersDir,
        APP_PATH . $config->get('application')->pluginsDir,
        APP_PATH . $config->get('application')->libraryDir,
        APP_PATH . $config->get('application')->modelsDir,
        APP_PATH . $config->get('application')->formsDir
    ]
);

$loader->register();

