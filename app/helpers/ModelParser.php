<?php

namespace App\Helpers;

class ModelParser{
    
    private $params = [];
    
    public function addParam($param){
        array_push($this->params, $param);
    }
    
    public function parse($modelName, $jsonData){
        $class = "\\App\\Models\\". $modelName;
        $model = new $class();
        
        foreach($this->params as $param){
            if(property_exists($jsonData, $param)){
                $model->$param = $jsonData->$param;
            }
        }
        
        return $model;
    }
    
}