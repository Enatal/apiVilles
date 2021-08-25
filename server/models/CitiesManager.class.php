<?php
require_once "Model.class.php";
require_once "City.class.php";

class CitiesManager extends Model{
     private $cities;
     private $table = "villes_france";
     private $keys=[
        "dept",
        "cityName",
        "postCode",
        "canton",
        "population",
        "density",
        "area"
    ];

     public function getCitiesByPostCode($code){

        // Considering this project uses DB_MANAGER == MEEDOO
        $cities=$this->getDatabase()->select($this->table,"*",[
            "code_postal[~]" => htmlspecialchars($code)
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
        $cities=$city=$this->getDatabase()->select($this->table,"*",[

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

            if(!exists($posts,$this->keys)){
                throw new Exception(" Un des champs (cityName, postCode, dept, canton, population, density, area) n'existe pas, à noter qu'il peuvent être vide, mais doivent exister");
            }else{
                if (empty($posts["cityName"]) || empty($posts["postCode"]) || empty($posts["dept"])) {
                    throw new Exception ("le nom, le code postal et le departement sont nécessaires à l'enregistrement");
                }else{
                    $result=$this->getDatabase()->select($this->table,[
                        "nom",
                        "code_postal"
                        ],[
                        "nom" => $posts["cityName"],
                        "code_postal [~]" => $posts["postCode"]
                        ]);
                    if($result){
                        throw new Exception ("Cet enregistrement existe déjà");
                    }else{
                        $result=$this->getDatabase()->insert($this->table,[
                            "departement" => $posts["dept"],
                            "nom" => $posts["cityName"],
                            "code_postal" => $posts["postCode"],
                            "canton" => $posts["canton"],
                            "population" => $posts["population"],
                            "densite" => $posts["density"],
                            "surface" => $posts["area"]
                        ]);
                        return $result;
                    }
                }
            }
    }

    public function updateCityWithPostCode($code,$posts){

        $this->getCitiesByPostCode($code);

        if(count($this->cities)>1){
            return $this->cities;
        }else{
            $result=$this->getDatabase()->update($this->table,[
                "departement" => $posts["dept"],
                "nom" => $posts["cityName"],
                "code_postal" => $posts["postCode"],
                "canton" => $posts["canton"],
                "population" => $posts["population"],
                "densite" => $posts["density"],
                "surface" => $posts["area"]
            ],[
                "id" => $this->cities->getId()
            ]);
            return $result;
        }
    }

    public function updateCityByPostPostCodeWithID($code,$id){
        // reflechir à la solution pour 2 villes ou plus qui ont le même code postal
        // Un selectCityToUpdate avant pour obtenir l'id ?
    }
}
?>