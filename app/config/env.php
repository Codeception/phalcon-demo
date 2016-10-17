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
 * @const APPLICATION_ENV Current application environment
 */
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : APP_PRODUCTION));

/**
 * @const APP_START_TIME The start time of the application, used for profiling
 */
define('APP_START_TIME', microtime(true));

/**
 * @const APP_START_MEMORY The memory usage at the start of the application, used for profiling
 */
define('APP_START_MEMORY', memory_get_usage());

/**
 * @const HOSTNAME Current hostname
 */
define('HOSTNAME', explode('.', gethostname())[0]);

/**
 * Set the default locale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Set timezone
 */
date_default_timezone_set('UTC');

/**
 * Set the MB extension encoding to the same character set
 */
if (function_exists('mb_internal_encoding')) {
    mb_internal_encoding('utf-8');
}

/**
 * Set the mb_substitute_character to "none"
 */
if (function_exists('mb_substitute_character')) {
    mb_substitute_character('none');
}

/**
 * Enable xdebug parameter collection in development mode to improve fatal stack traces.
 * Highly recommends use at least XDebug 2.2.3 for a better compatibility with Phalcon
 */
if (APPLICATION_ENV != APP_PRODUCTION && extension_loaded('xdebug')) {
    ini_set('xdebug.collect_vars', 'on');
    ini_set('xdebug.collect_params', 4);
    ini_set('xdebug.dump_globals', 'on');
    ini_set('xdebug.show_local_vars', 'on');
    ini_set('xdebug.max_nesting_level', 100);
    ini_set('xdebug.var_display_max_depth', 4);
}
