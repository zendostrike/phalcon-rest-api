<?php

namespace App\Models;

class Artist extends BaseModel
{

    public function initialize()
    {
      $this->setSource("artist");
    }

    public static function find($parameters = null)
    {
      return parent::find($parameters);
    }

    public static function findFirst($parameters = null)
    {
      return parent::findFirst($parameters);
    }

}
