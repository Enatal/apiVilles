<?php
$url = "http://127.0.0.1/apiVilles/server/ville/83600"; 
$data = array('dept' => '83', 'cityName' => 'Gothamcity', 'postCode' => '83605','population' => '', 'canton' => '22', 'density' =>'100', 'area' =>'50');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
$response = curl_exec($ch);
var_dump($response);
if (!$response) 
{
    return false;
}
?>