<?php

try {
  // Loading Configs
  $config = require(__DIR__ . '/../app/config/config.php');

  // Autoloading classes
  require __DIR__ . '/../app/config/loader.php';

  // Initializing DI container
  /** @var \Phalcon\DI\FactoryDefault $di */
  $di = require __DIR__ . '/../app/config/di.php';

  // Initializing application
  $app = new \Phalcon\Mvc\Micro();

  // Setting DI container
  $app->setDI($di);

  // Setting up routing
  require __DIR__ . '/../app/config/routes.php';

  // Making the correct answer after executing
  $app->after(
    function () use ($app) {
      // Returning a successful response
    }
  );

  // Processing request
  $app->handle();
} catch (\Exception $e) {
  // Returning an error response
}
