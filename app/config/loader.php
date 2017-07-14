<?php

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
  [
    'App\Services'    => realpath(__DIR__ . '/../services/'),
    'App\Resources' => realpath(__DIR__ . '/../resources/'),
    'App\Models'      => realpath(__DIR__ . '/../models/'),
  ]
);

$loader->register();
