<?php

require_once("models/CitiesManager.class.php");

class CitiesController{

    private $cityManager;

    public function __construct(){

        $this->cityManager=new CitiesManager();
    }

    // méthode appelée par l'endpoint GET /ville/{code_postal}
    public function outputCitiesByPostCode($code){

        $cities=$this->cityManager->getCitiesByPostCode($code);
        echo json_encode($cities);
  
    }

    public function outputPopulationsByPostCode($code){

        $cities=$this->cityManager->getPopulationsByPostCode($code);
        echo json_encode($cities,JSON_FORCE_OBJECT);

    }

    public function outputAreasByPostCode($code){

        $cities=$this->cityManager-> getAreasByPostCode($code);
        echo json_encode($cities,JSON_FORCE_OBJECT);

    }

}
?>