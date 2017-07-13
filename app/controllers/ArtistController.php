<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Services\BaseService;
use App\Services\ServiceException;
use App\Services\ArtistService;

/**
 * Operations with Artists: CRUD
 */
class ArtistController extends BaseController
{
    /**
     * Adding artist
     */
    public function addAction()
    {
      $errors = [];
      $data = [];

      $data['artist_name'] = $this->request->getPost('artist_name');
      if ((!empty($data['artist_name'])) && (!is_string($data['artist_name']))) {
        $errors['artist_name'] = 'String expected';
      }

      $data['real_name'] = $this->request->getPost('real_name');
      if ((!empty($data['real_name'])) && (!is_string($data['real_name']))) {
        $errors['real_name'] = 'String expected';
      }

      $data['born_date'] = $this->request->getPost('born_date');
      if ((!empty($data['born_date'])) && (!is_string($data['born_date']))) {
        $errors['artist_name'] = 'String expected';
      }

      if ($errors) {
        $exception = new Http400Exception(_('Input parameters validation error'), self::ERROR_INVALID_REQUEST);
        throw $exception->addErrorDetails($errors);
      }

      try {
        $this->artistService->createArtist($data);
      } catch (ServiceException $e) {
        switch ($e->getCode()) {
          case BaseService::ERROR_ALREADY_EXISTS:
          case ArtistService::ERROR_UNABLE_CREATE_ARTIST:
            throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
          default:
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }
      }

    }

    /**
     * Returns Artist list
     *
     * @return array
     */
    public function getArtistListAction()
    {

    }

     /**
     * Updating existing artist
     *
     * @param string $userId
     */
    public function updateArtistAction($artistId)
    {

    }

    /**
     * Delete an existing user
     *
     * @param string $userId
     */
    public function deleteArtistAction($artistId)
    {

    }
}
