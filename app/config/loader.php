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
        'PhalconDemo\Controllers' => DOCROOT . $config->get('application')->controllersDir,
        'PhalconDemo\Forms'       => DOCROOT . $config->get('application')->formsDir,
        'PhalconDemo\Models'      => DOCROOT . $config->get('application')->modelsDir,
        'PhalconDemo\Plugins'     => DOCROOT . $config->get('application')->pluginsDir,
        'PhalconDemo\Library'     => DOCROOT . $config->get('application')->libraryDir
    ]
);

$loader->register();
