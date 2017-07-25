<?php

namespace App\Models;

class Artist extends BaseModel{
    public function initialize(){
      $this->setSource("artist");
    }
}