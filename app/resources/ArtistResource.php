<?php

namespace App\Resources;


class ArtistResource extends BaseResource implements IResource
{
    public function addAction() {
        
    }

    public function deleteAction($_identifier) {
        
    }

    public function getAction($_identifier) {
        
    }

    public function listAction() {
        
        $artists = array(
            "artist_name" => "Michael Jackson",
            "real_name" => "Michael Joseph Jackson",
            "img" => "http://lakerholicz.com/wp-content/uploads/2014/02/michael-jackson.jpg"
        );
        
        return $artists;
        
    }

    public function updateAction($_identifier) {
        
    }

}
