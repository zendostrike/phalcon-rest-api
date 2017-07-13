<?php

namespace App\Services;

use App\Models\Artist;

/**
 * business logic for users
 *
 * Class UsersService
 */
class ArtistService extends BaseService
{
  /** Unable to create user */
  const ERROR_UNABLE_CREATE_ARTIST = 11001;

  /**
   * Creating a new artist
   *
   * @param array $artistData
   */
  public function createArtist(array $artistData)
  {
    try {
    $artist   = new Users();
    $artist->artist_name = $artistData['artist_name'];
    $artist->real_name = $artistData['real_name'];
    $artist->born_date = $artistData['born_date'];
    $artist->img = $artistData['img'];

    $result = $artist->create();

    if (!$result) {
      throw new ServiceException('Unable to create user', self::ERROR_UNABLE_CREATE_USER);
    }

    } catch (\PDOException $e) {
      if ($e->getCode() == 23505) {
        throw new ServiceException('User already exists', self::ERROR_ALREADY_EXISTS, $e);
      } else {
        throw new ServiceException($e->getMessage(), $e->getCode(), $e);
      }
    }
  }
}
