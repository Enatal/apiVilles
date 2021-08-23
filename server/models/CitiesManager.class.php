<?php
require_once "Model.class.php";
require_once "City.class.php";

class CitiesManager extends Model{
     private $cities;

     public function getCitiesByPostCode($code){
        // Considering this project uses DB_MANAGER == MEEDOO

        $cities=getDataBase()->select("villes_france","*",[
            "code_postal[=]" => $code
        ]);
        foreach ($cities as $city) {
            # code...
        }
        $new_city=new City(
            $city["id"],
            $city["departement"],
            $city["nom"],
            $city["code_postale"],
            $city["canton"],
            $city["population"],
            $city["densite"],
            $city["surface"]
        );

        $this->cities[$new_city->getId()]=$new_city;
     }

     public function getPopulationByPostCode($code){

        $population=array();
        $this->getCityByPostCode($code);
        foreach ($this->cities as $city) {
            $population[]=$city->getPopulation();
        }
         return $population;
     }

     public function getAreaByPostCode($code){
         
        $city=$this->getCityByPostCode($code);
        return $city->getArea();
    }

    public function getCitiesByDept($dept){
        // Considering this project uses DB_MANAGER == MEEDOO

        $cities=$city=getDataBase()->select("villes_france","*",[
            "departement[=]" => $dept
        ]);
        foreach ($cities as $city) {
            $new_city=new City(
                $city["id"],
                $city["departement"],
                $city["nom"],
                $city["code_postale"],
                $city["canton"],
                $city["population"],
                $city["densite"],
                $city["surface"]
            );
            $this->cities[$new_city->getId()]=$new_city;
        }
    }

    public function getCitiesByCantonInDept($dept,$canton){
        $this->getCitiesByDept($dept);
        $cities;
    }
}
?>