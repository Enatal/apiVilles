<?php
require_once "Model.class.php";
require_once "City.class.php";

class CitiesManager extends Model{
     private $cities;

     public function getCitiesByPostCode($code){

        // Considering this project uses DB_MANAGER == MEEDOO
        $cities=$this->getDatabase()->select("villes_france","*",[
            "code_postal" => $code
        ]);
        var_dump($cities);
        foreach ($cities as $city) {
            $new_city=new City(
                $city["id"],
                $city["departement"],
                $city["nom"],
                $city["code_postal"],
                $city["canton"],
                $city["population"],
                $city["densite"],
                $city["surface"]
            );
            $this->cities[$new_city->getId()]=$new_city;
        }
        var_dump($this->cities);
        return $this->cities;
        
     }

    public function getCitiesByDept($dept){

        // Considering this project uses DB_MANAGER == MEEDOO
        $cities=$city=$this->getDatabase()->select("villes_france","*",[
            "departement" => $dept
        ]);
        foreach ($cities as $city) {
            $new_city=new City(
                $city["id"],
                $city["departement"],
                $city["nom"],
                $city["code_postal"],
                $city["canton"],
                $city["population"],
                $city["densite"],
                $city["surface"]
            );
            $this->cities[$new_city->getId()]=$new_city;
        }
        return $this->cities;
    }

     public function getPopulationsByPostCode($code){

        $populations=array();
        $this->getCitiesByPostCode($code);
        foreach ($this->cities as $city) {
            $populations[]=$city->getPopulation();
        }
         return $populations;
     }

     public function getAreaByPostCode($code){
         
        $areas=array();
        $this->getCitiesByPostCode($code);
        foreach ($this->cities as $city) {
            $areas[]=$city->getPopulation();
        }
         return $areas;
    }

    public function getCitiesByCantonInDept($dept,$canton){

        $this->getCitiesByDept($dept);
        $cities=array();
        foreach ($this->cities as $city) {
            if($city->getCanton()==$canton){
                $cities[]=$city;
            }
        }
    }

    public function UpdateCityByPostCode($code){
        // reflechir à la solution pour 2 villes ou plus qui ont le même code postal
        // Une selectCityToUpdate ?
    }
}
?>