<?php

$executionStartTime = microtime(true) / 1000;

require 'myCredentials.php';

$username = $geonamesUsername;


$url='http://api.geonames.org/searchJSON?q=&east='.$_REQUEST['east'].'&west='.$_REQUEST['west'].'&north='.$_REQUEST['north'].'&south='.$_REQUEST['south'].'&username='.$username;

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);

$result=curl_exec($ch);

curl_close($ch);

$decode = json_decode($result,true);

$output['status']['code'] = "200";
$output['status']['name'] = "ok";
$output['status']['description'] = "borders received";
$output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
$output['data'] = $decode;

header('Content-Type: application/json; charset=UTF-8');

echo json_encode($output);