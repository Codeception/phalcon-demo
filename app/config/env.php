<?php

error_reporting(E_ALL);

/**
 * @const DOCROOT Document root
 */
define('DOCROOT', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR);

if (!file_exists(DOCROOT . 'vendor/autoload.php')) {
    throw new \RuntimeException(
        'Unable to locate autoloader. ' .
        'Install dependencies from the project root directory to run test suite: `composer install`.'
    );
}

/**
 * Include Composer autoloader
 */
include DOCROOT . 'vendor/autoload.php';

/**
 * @const DOCROOT Main application path
 */
define('APP_PATH', DOCROOT . 'app' . DIRECTORY_SEPARATOR);

/**
 * @const APP_PRODUCTION Application production stage
 */
define('APP_PRODUCTION', 'production');

/**
 * @const APP_STAGING Application staging stage
 */
define('APP_STAGING', 'staging');

/**
 * @const APP_DEVELOPMENT Application development stage
 */
define('APP_DEVELOPMENT', 'development');

/**
 * @const APP_TEST Application test stage
 */
define('APP_TEST', 'testing');

/**
 * @const APP_DEVELOPMENT Current application stage
 */
define('APP_STAGE', (getenv('APP_ENV') ? getenv('APP_ENV') : APP_PRODUCTION));
