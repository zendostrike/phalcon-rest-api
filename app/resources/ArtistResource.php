<?php

namespace App\Resources;

use App\Models\Artist;

class ArtistResource extends BaseResource implements IResource
{
    
    public function onConstruct(){
        $this->addParam("artist_name");
        $this->addParam("real_name");
        $this->addParam("born_date");
        $this->addParam("img");
    }
    
    public function addAction() {
        
        $jsonData = $this->request->getJsonRawBody();
        $newArtist = $this->parse("Artist", $jsonData);
        
        $newArtist->create();
        
        return $newArtist;
        
    }

    public function deleteAction($_identifier) {

        $artist = Artist::findFirst($_identifier);
        
        $artist->delete();
        
        return "Artist deleted";
    }

    public function getAction($_identifier) {
        $artist = Artist::findFirst($_identifier);
        return $artist;
    }

    public function listAction() {

        $artists = Artist::find();
        return $artists;

    }

    public function updateAction($_identifier) {
        
        
        $jsonData = $this->request->getJsonRawBody();
        $updatedArtist = $this->parse("Artist", $jsonData);
        
        $artist = Artist::findFirst($_identifier);
        
        if($artist){
            $this->patchChanges($artist, $updatedArtist);
            $artist->update();
        } else {
            $updatedArtist->create();
        }
        
        return $artist;
    }

}
