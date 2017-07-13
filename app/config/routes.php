<?php

$artistCollection = new \Phalcon\Mvc\Micro\Collection();
$artistCollection->setHandler('\App\Controllers\UsersController', true);
$artistCollection->setPrefix('/artist');
$artistCollection->post('/add', 'addAction');
$artistCollection->get('/list', 'getArtistListAction');
$artistCollection->put('/{artistId:[1-9][0-9]*}', 'updateArtistAction');
$artistCollection->delete('/{artistId:[1-9][0-9]*}', 'deleteArtistAction');

$app->mount($artistCollection);

// not found URLs
$app->notFound(
  function () use ($app) {
      $exception =
        new \App\Controllers\HttpExceptions\Http404Exception(
          _('URI not found or error in request.'),
          \App\Controllers\BaseController::ERROR_NOT_FOUND,
          new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
        );
      throw $exception;
  }
);
