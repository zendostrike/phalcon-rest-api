<?php

namespace App\Services;

use App\Models\Artist;

/**
 * business logic for artists
 *
 * Class ArtistService
 */
class ArtistService extends BaseService
{
  /** Unable to create artist */
  const ERROR_UNABLE_CREATE_ARTIST = 11001;

  /**
   * Creating a new artist
   *
   * @param array $artistData
   */
  public function createArtist(array $artistData)
  {
    try {
    $artist = new Artist();
    $artist->artist_name = $artistData['artist_name'];
    $artist->real_name = $artistData['real_name'];
    $artist->born_date = $artistData['born_date'];
    $artist->img = $artistData['img'];

    $result = $artist->create();

    if (!$result) {
      throw new ServiceException('Unable to create artist', self::ERROR_UNABLE_CREATE_ARTIST);
    }

    } catch (\PDOException $e) {
      if ($e->getCode() == 23505) {
        throw new ServiceException('Artist already exists', self::ERROR_ALREADY_EXISTS, $e);
      } else {
        throw new ServiceException($e->getMessage(), $e->getCode(), $e);
      }
    }
  }
}
