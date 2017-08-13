<?php

namespace App\Validators;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class ArtistValidator extends Validation
{
    public function initialize()
    {
        $this->add('artist_name', new PresenceOf(
                [
                    'message' => 'The artist_name is required',
                ]
            )
        );
        
    }
}