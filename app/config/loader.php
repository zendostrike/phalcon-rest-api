<?php

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
  [
    'App\Resources' => realpath(__DIR__ . '/../resources/'),
    'App\Models'      => realpath(__DIR__ . '/../models/'),
    'App\Helpers'      => realpath(__DIR__ . '/../helpers/'),
  ]
);

$loader->register();
