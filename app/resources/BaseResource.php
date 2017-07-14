<?php

namespace App\Resources;

abstract class BaseResource extends \Phalcon\DI\Injectable
{
    /**
     * Route not found. HTTP 404 Error
     */
    const ERROR_NOT_FOUND = 1;

    /**
     * Invalid Request. HTTP 400 Error.
     */
    const ERROR_INVALID_REQUEST = 2;
}
