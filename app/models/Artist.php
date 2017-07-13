<?php

namespace App\Models;

class Users extends \Phalcon\Mvc\Model
{

    public function initialize()
    {
	    $this->setSource("artists");
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
