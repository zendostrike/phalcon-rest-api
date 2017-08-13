<?php

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => 'dev123',
            'dbname' => 'music_rating',
        ],

        'application' => [
            'resourcesDir' => "app/resources/",
            'modelsDir' => "app/models/",
            'baseUri' => "/",
            'env' => "DEV"
        ],
    ]
);
