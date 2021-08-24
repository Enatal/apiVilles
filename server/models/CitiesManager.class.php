<?php
require_once "Model.class.php";
require_once "City.class.php";

class CitiesManager extends Model{
     private $cities;

     public function getCitiesByPostCode($code){

        // Considering this project uses DB_MANAGER == MEEDOO
        $cities=$this->getDatabase()->select("villes_france","*",[
            "code_postal[~]" => hmlspecialchars($code)
        ]);
        //var_dump($cities);
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
            $this->cities[$new_city->getId()]= $new_city->_toJson();
        }
        return $this->cities;
     }

    public function getCitiesByDept($dept){

        // Considering this project uses DB_MANAGER == MEEDOO
        $cities=$city=$this->getDatabase()->select("villes_france","*",[
            "departement" => htmlspecialchars($dept)
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
            $this->cities[$new_city->getId()]=$new_city->_toJson();
        }
        return $this->cities;
    }

     public function getPopulationsByPostCode($code){

        $populations=array();
        $this->getCitiesByPostCode($code);
        if($this->cities !=NULL){
            foreach ($this->cities as $city) {
            $populations[$city["id"]]=array("population" => $city["population"]);
            }
        }
         return $populations;
     }

     public function getAreasByPostCode($code){
         
        $areas=array();
        $this->getCitiesByPostCode($code);
        foreach ($this->cities as $city) {
            $areas[$city["id"]]=array("area" => $city["area"]);
        }
         return $areas;
    }

    public function getCitiesByCantonInDept($dept,$canton){

        $this->getCitiesByDept($dept);
        $cities=array();
        foreach ($this->cities as $city) {
            if($city["canton"]==$canton){
                $cities[$city["id"]]=$city;
            }
        }
        return $cities;
    }

    public function addNewCity($posts){
        $result=$this->getDatabase()->insert("villes_france",[
            "departement" => $posts["dept"],

        ]);
    }

    public function updateCityByPostCode($code,$id){
        // reflechir à la solution pour 2 villes ou plus qui ont le même code postal
        // Un selectCityToUpdate avant ? pour obtenir l'id
    }
}
?>