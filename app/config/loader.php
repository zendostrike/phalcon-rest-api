<?php

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
  [
    'App\Resources' => realpath(__DIR__ . '/../resources/'),
    'App\Models'      => realpath(__DIR__ . '/../models/'),
    'App\Exceptions' => realpath(__DIR__ . '/../exceptions/'),
    'App\Validators' => realpath(__DIR__ . '/../validators/'),
  ]
);

$loader->register();
