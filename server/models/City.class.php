<?php
class City extends Model{

    private $id;
    private $dept;
    private $cityName;
    private $postCode;
    private $canton;
    private $population;
    private $density;
    private $area;

    public function __construct($id,$dept,$name,$postcode,$canton,$pop,$density,$area){
        $this->id=$id;
        $this->dept=$dept;
        $this->cityName=$name;
        $this->postCode=$postcode;
        $this->canton=$canton;
        $this->population=$pop;
        $this->density=$density;
        $this->area=$area;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }

    public function getDept(){
        return $this->dept;
    }
    public function setDept($dept){
        $this->dept=$dept;
    }

    public function getCityName(){
        return $this->cityName;
    }
    public function setCityName($name){
        $this->cityName=$name;
    }

    public function getPostCode(){
        return $this->postCode;
    }
    public function setPostCode($code){
        $this->postCode=$code;
    }

    public function getCanton(){
        return $this->canton;
    }
    public function setCanton($canton){
        $this->canton=$canton;
    }

    public function getPopulation(){
        return $this->population;
    }
    public function setPopulation($pop){
        $this->population=$pop;
    }

    public function getDensity(){
        return $this->density;
    }
    public function setDensity($density){
        $this->density=$density;
    }

    public function getArea(){
        return $this->density;
    }
    public function setArea($area){
        $this->area=$area;
    }

    public function _toJson(){
       return get_object_vars($this);
    }
}
?>