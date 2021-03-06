<?php

define('REQUEST_MICROTIME', microtime(true));

chdir(dirname(__DIR__));

if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

require 'init_autoloader.php';

Zend\Mvc\Application::init(require 'config/application.config.php')->run();
