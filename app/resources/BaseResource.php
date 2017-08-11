<?php

namespace App\Resources;

use Phalcon\Mvc\Controller;

class BaseResource extends Controller
{
    const ERROR_NOT_FOUND = 1;
    const ERROR_INVALID_REQUEST = 2;
    const MODEL_DIR = "\\App\\Models\\";
    
    private $params = [];
    public $errors = [];
    
    public function addParam($param){
        if(is_string($param)) {
            array_push($this->params, [
                "field" => $param,
                "mandatory" => false
                ]);
        } else {
            array_push($this->params, $param);
        }
    }
    
    /**
     * Load changed properties of a model to finded model
     * @param Object $modelName
     * @param Object $jsonRawBody
     */
    public function parse($modelName, $jsonRawBody){
        $class = self::MODEL_DIR. $modelName;
        $model = new $class();
        
        foreach($this->params as $param){
            if(property_exists($jsonRawBody, $param["field"])){
                $model->$param = $jsonRawBody->$param["field"];
            } else {
                if($param["mandatory"]){
                    array_push($this->errors, $param["field"] . " is mandatory.");
                }
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
