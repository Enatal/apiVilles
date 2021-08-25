<?php
  $url = 'http://127.0.0.1/apiVilles/server/ville';
  $data = array('dept' => '83', 'cityName' => 'Gothamcity', 'postCode' => '83601', 'canton' => '22', 'population' => '1', 'density' =>'50', 'area' =>'50');
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) { /* Handle error */ }
  var_dump($result);
?>