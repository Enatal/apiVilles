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

    public function outputCitiesByDept($dept){

        $cities=$this->cityManager->getCitiesByDept($dept);
        echo json_encode($cities);
  
    }

    public function getCitiesByCantonInDept($dept,$canton){

        $cities=$this->cityManager->getCitiesByCantonInDept($dept,$canton);
        echo json_encode($cities);
  
    }
    public function recordNewCity($posts){
        $result = $this->cityManager->addNewCity($posts);
        echo json_encode($result->rowCount());
    }

    public function ModifyCitiesByPostCode($code,$posts){

        $result=$this->cityManager-> updateCityWithPostCode($code,$posts);
        echo json_encode($result);

    }
}
?>