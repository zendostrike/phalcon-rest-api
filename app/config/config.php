<?php

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => 'dev123',
            'dbname' => 'muchik',
        ],

        'application' => [
            'resourcesDir' => "app/resources/",
            'modelsDir' => "app/models/",
            'baseUri' => "/",
        ],
    ]
);
