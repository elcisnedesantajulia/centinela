<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces([
    'Centinela\Models'       => $config->application->modelsDir,
    'Centinela\Controllers'  => $config->application->controllersDir,
    'Centinela\Forms'        => $config->application->formsDir,
    'Centinela'              => $config->application->libraryDir,
]);

$loader->register();

