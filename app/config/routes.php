<?php

$artistCollection = new \Phalcon\Mvc\Micro\Collection();
$artistCollection->setHandler('\App\Resources\ArtistResource', true);
$artistCollection->setPrefix('/artist');
$artistCollection->post('/add', 'addAction');
$artistCollection->get('/list', 'listAction');
$artistCollection->put('/{artistId:[1-9][0-9]*}', 'updateAction');
$artistCollection->delete('/{artistId:[1-9][0-9]*}', 'deleteAction');

$app->mount($artistCollection);

// not found URLs
$app->notFound(
  function () use ($app) {
      $exception =
        new \App\Resources\HttpExceptions\Http404Exception(
          _('URI not found or error in request.'),
          \App\Resources\BaseResource::ERROR_NOT_FOUND,
          new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
        );
      throw $exception;
  }
);
