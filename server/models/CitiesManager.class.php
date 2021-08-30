<?php
require_once "Model.class.php";
require_once "City.class.php";

class CitiesManager extends Model{
     private $cities;
     private $city;
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

    public function getCityById($id){
        $city=$this->getDatabase()->select($this->table,"*",[
            "id" => $id
        ]);
        //print_r($city);
        $new_city=new City(
            $city[0]["id"],
            $city[0]["departement"],
            $city[0]["nom"],
            $city[0]["code_postal"],
            $city[0]["canton"],
            $city[0]["population"],
            $city[0]["densite"],
            $city[0]["surface"]
        );
        //print_r($new_city);
        $this->city=$new_city->_toJson();
        return $this->city;
    }

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
        }else{
            $populations = NULL;
        }
         return $populations;
     }

     public function getAreasByPostCode($code){
         
        $areas=array();
        $this->getCitiesByPostCode($code);
        if(empty($this->cities)){
            $areas=NULL;
        }else{
            foreach ($this->cities as $city) {
                $areas[$city["id"]]=array("area" => $city["area"]);
            }
        }
         return $areas;
    }

    public function getCitiesByCantonInDept($dept,$canton){

        $this->getCitiesByDept($dept);
        $cities=array();
        if(empty($this->cities)){
            $cities=NULL;
        }else{
            foreach ($this->cities as $city) {
                if($city["canton"]==$canton){
                    $cities[$city["id"]]=$city;
                }
            }
        }
        return $cities;
    }

    public function addNewCity($posts){

            if(!exists($posts,$this->keys)){
                throw new Exception(" Un des champs (cityName, postCode, dept, canton, population, density, area) n'existe pas, à noter qu'ils peuvent être vide, mais doivent exister");
            }else{
                if (empty($posts["cityName"]) || empty($posts["postCode"]) || empty($posts["dept"])) {
                    throw new Exception ("le nom, le code postal et le departement sont nécessaires à l'enregistrement");
                }else{
                    $result=$this->getDatabase()->select($this->table,[
                        "nom",
                        "code_postal"
                        ],[
                        "nom" => htmlspecialchars($posts["cityName"]),
                        "code_postal [~]" => htmlspecialchars($posts["postCode"])
                        ]);
                    if($result){
                        throw new Exception ("Cet enregistrement existe déjà");
                    }else{
                        $result=$this->getDatabase()->insert($this->table,[
                            "departement" => htmlspecialchars($posts["dept"]),
                            "nom" => htmlspecialchars($posts["cityName"]),
                            "code_postal" => htmlspecialchars($posts["postCode"]),
                            "canton" => htmlspecialchars($posts["canton"]),
                            "population" => htmlspecialchars($posts["population"]),
                            "densite" => htmlspecialchars($posts["density"]),
                            "surface" => htmlspecialchars($posts["area"])
                        ]);
                        return $result;
                    }
                }
            }
    }

    public function updateCityWithPostCode($code,$posts){
        if(!exists($posts,$this->keys)){
            throw new Exception(" Un des champs (cityName, postCode, dept, canton, population, density, area) n'existe pas, à noter qu'ils peuvent être vide, mais doivent exister");
        }else{
            $this->getCitiesByPostCode($code);
            if($this->cities == NULL){
                throw new Exception ("Cet enregistrement n'existe pas");
            }else{
                if(count($this->cities)>1){
                    return $this->cities;
                }else{
                    //print_r($this->city);
                    $city=$this->getCityById(array_key_first($this->cities));
                    if(empty($posts["dept"])){
                        $posts["dept"] = $city["dept"];
                    }
                    if(empty($posts["cityName"])){
                        $posts["cityName"] = $city["cityName"];
                    }
                    if(empty($posts["postCode"])){
                        $posts["postCode"] = $city["postCode"];
                    }
                    if(empty($posts["canton"])){
                        $posts["canton"] = $city["canton"];
                    }
                    if(empty($posts["population"])){
                        $posts["population"] = $city["population"];
                    }
                    if(empty($posts["density"])){
                        $posts["density"] = $city["density"];
                    }
                    if(empty($posts["area"])){
                        $posts["area"] = $city["area"];
                    }
                    $result=$this->getDatabase()->update($this->table,[
                        "departement" => htmlspecialchars($posts["dept"]),
                        "nom" => htmlspecialchars($posts["cityName"]),
                        "code_postal" => htmlspecialchars($posts["postCode"]),
                        "canton" => htmlspecialchars($posts["canton"]),
                        "population" => htmlspecialchars($posts["population"]),
                        "densite" => htmlspecialchars($posts["density"]),
                        "surface" => htmlspecialchars($posts["area"])
                    ],[
                        "code_postal" => htmlspecialchars($code)
                    ]);
                    return $this->getCityById($city["id"]);
                }
            }
        }
       

    }

    public function updateCityById($id,$posts){
        // reflechir à la solution pour 2 villes ou plus qui ont le même code postal
        // Un selectCityToUpdate avant pour obtenir l'id ?
        if(!exists($posts,$this->keys)){
            throw new Exception(" Un des champs (cityName, postCode, dept, canton, population, density, area) n'existe pas, à noter qu'ils peuvent être vide, mais doivent exister");
        }else{
            $city=$this->getCityById($id);
            if($city == NULL){
                throw new Exception ("Cet enregistrement n'existe pas");
            }else{
                if(empty($posts["dept"])){
                    $posts["dept"] = $city["dept"];
                }
                if(empty($posts["cityName"])){
                    $posts["cityName"] = $city["cityName"];
                }
                if(empty($posts["postCode"])){
                    $posts["postCode"] = $city["postCode"];
                }
                if(empty($posts["canton"])){
                    $posts["canton"] = $city["canton"];
                }
                if(empty($posts["population"])){
                    $posts["population"] = $city["population"];
                }
                if(empty($posts["density"])){
                    $posts["density"] = $city["density"];
                }
                if(empty($posts["area"])){
                    $posts["area"] = $city["area"];
                }
                    $result=$this->getDatabase()->update($this->table,[
                        "departement" => htmlspecialchars($posts["dept"]),
                        "nom" => htmlspecialchars($posts["cityName"]),
                        "code_postal" => htmlspecialchars($posts["postCode"]),
                        "canton" => htmlspecialchars($posts["canton"]),
                        "population" => htmlspecialchars($posts["population"]),
                        "densite" => htmlspecialchars($posts["density"]),
                        "surface" => htmlspecialchars($posts["area"])
                    ],[
                        "id" => htmlspecialchars($id)
                    ]);
                    return $this->getCityById($id);
                
            }
        }
    }
}
?>