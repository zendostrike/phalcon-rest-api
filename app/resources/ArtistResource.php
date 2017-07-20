<?php

namespace App\Resources;

use App\Helpers\ModelParser;
use Phalcon\Mvc\Controller;

class ArtistResource extends Controller implements IResource
{
    
    private $modelParser;
    
    public function onConstruct(){
        $this->modelParser = new ModelParser();
        $this->modelParser->addParam("artist_name");
        $this->modelParser->addParam("real_name");
        $this->modelParser->addParam("born_date");
        $this->modelParser->addParam("img");
    }
    
    public function addAction() {
        
        $jsonData = $this->request->getJsonRawBody();
        $o_artist = $this->modelParser->parse("Artist", $jsonData);
        
        $o_artist->save();
        
        return $o_artist;
        
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
