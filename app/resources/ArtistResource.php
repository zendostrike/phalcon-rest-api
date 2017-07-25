<?php

namespace App\Resources;

use App\Models\Artist;

class ArtistResource extends BaseResource implements IResource{
    
    public function onConstruct(){
        $this->addParam("artist_name");
        $this->addParam("real_name");
        $this->addParam("born_date");
        $this->addParam("img_url");
    }
    
    public function addAction() {
        $jsonRawBody = $this->request->getJsonRawBody();
        
        $artist = $this->parse("Artist", $jsonRawBody);
        $artist->create();
        
        return $artist;
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
        return Artist::find();
    }

    public function updateAction($_identifier) {
        $jsonData = $this->request->getJsonRawBody();
        
        $updatedArtist = $this->parse("Artist", $jsonData);
        $artist = Artist::findFirst($_identifier);
        
        if(!$artist){
            $updatedArtist->create();
            return $updatedArtist;
        }
        
        $this->patchChanges($artist, $updatedArtist);
        $artist->update();
        
        return $artist ? $artist : $updatedArtist;
    }

}
