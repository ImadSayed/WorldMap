<?php

    $executionStartTime = microtime(true);

    $countryData = json_decode(file_get_contents("../JSON/countryBorders.geo.json"), true);
    $country = [];
    foreach ($countryData['features'] as $feature) {
        $temp = null;
        $temp['code'] = $feature["properties"]['iso_a2'];
        $temp['name'] = $feature["properties"]['name'];
        $temp['iso_a3'] = $feature["properties"]['iso_a3'];
        array_push($country, $temp);
    }

    usort($country, function ($item1, $item2) {
        return $item1['name'] <=> $item2['name'];
    });

    $output['status']['code'] = "200";
    $output['status']['name'] = "ok";
    $output['status']['description'] = "success";
    $output['status']['executedIn'] = intval((microtime(true) - $executionStartTime) * 1000) . " ms";
    $output['data'] = $country;

    header('Content-Type: application/json; charset=UTF-8');

    echo json_encode($output);

 ?>