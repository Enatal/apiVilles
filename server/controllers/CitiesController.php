<?php

require_once("models/CitiesManager.class.php");

class CitiesController{

    private $cityManager;

    public function __construct(){

        $this->cityManager=new CitiesManager();
    }

    // méthode appelée par l'endpoint GET /ville/{code_postal}
    public function outputCitiesByPostCode($code){

        $this->cityManager->getCitiesByPostCode($code);
        echo json_encode($this->cityManager->cities);

        require_once("views/cities.php");
    }

}
?>