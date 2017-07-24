<?php

namespace App\Resources;

use Phalcon\Mvc\Controller;

class BaseResource extends Controller
{

    const ERROR_NOT_FOUND = 1;
    const ERROR_INVALID_REQUEST = 2;
    const MODEL_DIR = "\\App\\Models\\";
    
    private $params = [];
    
    public function addParam($param){
        array_push($this->params, $param);
    }
    
    
    /**
     * Load changed properties of a model to finded model
     * @param Object $modelName
     * @param Object $jsonData
     */
    public function parse($modelName, $jsonData){
        $class = self::MODEL_DIR. $modelName;
        $model = new $class();
        
        foreach($this->params as $param){
            if(property_exists($jsonData, $param)){
                $model->$param = $jsonData->$param;
            }
        }
        
        return $model;
    }
    
    /**
     * Load changed properties of a model to finded model
     * @param Object $model
     * @param Object $modelWithChanges
     */
    public function patchChanges(&$model, $modelWithChanges){
        foreach($modelWithChanges as $key => $property){
            if($property){
                $model->$key = $property;
            }
        }
    }
}
