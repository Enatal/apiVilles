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
        var_dump($cities);
        echo json_encode($cities);

    }

}
?>