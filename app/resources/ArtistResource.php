<?php

namespace App\Resources;

use App\Models\Artist;
use App\Validators\ArtistValidator;

class ArtistResource extends BaseResource implements IResource{
    
    private $errors = [];
    
    // Default params that will be catched by the parser
    public function onConstruct(){
        $this->addParam("artist_name");
        $this->addParam("real_name");
        $this->addParam("born_date");
        $this->addParam("img_url");
    }
    
    // Create new artist
    public function addAction() {
        
        // Initialize validation and validate json posted
        $validation = new ArtistValidator();
        $jsonRawBody = $this->request->getJsonRawBody();
        $messages = $validation->validate($jsonRawBody);
        
        // If errors exists, then throw error description and details
        if (count($messages)) {
            foreach ($messages as $message) {
                array_push($this->errors, (string)$message);
            }
            
            $exception = new \App\Exceptions\Http400Exception(
                    'Input parameters validation error',
                    self::ERROR_INVALID_REQUEST);
            
            throw $exception->addErrorDetails($this->errors);
        }
        
        // Transform jsonRawBody to Artist Model
        $artist = $this->parse("Artist", $jsonRawBody); 
        $artist->create();
        
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
