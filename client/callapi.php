<?php
/*
    Authors: Thibaut
    Created on: 2021/08/21
    Last Update: 2021/08/21
    Version: 0.0.1
    Comments: fichier client d'interaction avec l'api REST
*/
class Callapi{

    private $client;
    private $key;
    private $url;

    public function __construct($user,$apikey,$apiurl){
        $this->client=$user;
        $this->key=$apikey;
        $this->url=$apiurl;
    }

    public function request($args, $method="GET"){
        switch ($method) {
            case 'GET':
                $ch=curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->url."?".$args);	
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result=(array)json_decode(curl_exec($ch));
                break;
            case 'POST':
                $enc_request=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$this->key,json_encode($args),MCRYPT_MODE_ECB));
                $params=array();
                $params["enc_request"]=$enc_request;
                $params["client"]=$this->client;
        
                $ch=curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->url);	
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, count($params));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        
                $result=(array)json_decode(curl_exec($ch));
            default:
                $result[0]="this method isn't allowed";
                break;
        }


        return $result;
    }
}
?>