<?php

use Phalcon\Db\Adapter\Pdo\Mysql;

// Initializing a DI Container
$di = new \Phalcon\DI\FactoryDefault();

/**
 * Overriding Response-object to set the Content-type header globally
 */
$di->setShared(
  'response',
  function () {
      $response = new \Phalcon\Http\Response();
      $response->setContentType('application/json', 'utf-8');

      return $response;
  }
);

/** Common config */
$di->setShared('config', $config);

/** Database */
$di->set(
  "db",
  function () use ($config) {
      return new Mysql(
        [
          "host"     => $config->database->host,
          "username" => $config->database->username,
          "password" => $config->database->password,
          "dbname"   => $config->database->dbname,
        ]
      );
  }
);

return $di;
