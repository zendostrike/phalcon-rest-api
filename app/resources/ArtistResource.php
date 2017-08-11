<?php

namespace App\Resources;

use App\Models\Artist;

class ArtistResource extends BaseResource implements IResource{
    
    // Default params that will be catched by the parser
    public function onConstruct(){
        $this->addParam(["field" => "artist_name", "mandatory" => true ]);
        $this->addParam("real_name");
        $this->addParam("born_date");
        $this->addParam("img_url");
    }
    
    // Create new artist
    public function addAction() {
        $jsonRawBody = $this->request->getJsonRawBody();

        $artist = $this->parse("Artist", $jsonRawBody); //Returns a phalcon model
        
        if(!$artist->create()){
            $exception = new \App\Exceptions\Http400Exception(
                    'Input parameters validation error',
                    self::ERROR_INVALID_REQUEST);
            
            throw $exception->addErrorDetails($this->errors);
        }
        
        return $artist;
    }
    
    // Delete existing artist
    public function deleteAction($_identifier) {
        $artist = Artist::findFirst($_identifier);
        
        if(!$artist){
            return ["msg" => "Artist does not exist"];
        }
        
        $artist->delete();
        
        return ["msg" => "Artist deleted"];
    }
    
    // Get existing artist
    public function getAction($_identifier) {
        $artist = Artist::findFirst($_identifier);
        
        if(!$artist){
            return ["msg" => "Artist not found"];
        }
        
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
