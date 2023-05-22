<?php

use Phalcon\Autoload\Loader;

$loader = new Loader();

$loader->setDirectories
(
    array
    (
        APP_PATH . 'app/controllers/',
        APP_PATH . 'app/models/',
        APP_PATH . 'app/repositories/',
        APP_PATH . 'app/responses/',
        APP_PATH . 'app/exceptions/'
    )

)->register();

$loader->setNamespaces
(
    array
    (
        'app\\controllers' => APP_PATH . 'app/controllers',
        'app\\config' => APP_PATH . 'app/config',
        'app\\models' => APP_PATH . 'app/models',
        'app\\repositories' => APP_PATH . 'app/repositories',
        'app\\responses' => APP_PATH . 'app/responses',
        'app\\exceptions' => APP_PATH . 'app/exceptions'
    )

)->register();