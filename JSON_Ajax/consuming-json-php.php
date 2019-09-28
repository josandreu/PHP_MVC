<?php

// http://api.openweathermap.org/data/2.5/weather?id=3128832&APPID=8e11f356c400d9ab531668301176322e

// solicitamos a la API, nos devuelve un json
$json = file_get_contents("http://api.openweathermap.org/data/2.5/weather?id=3128832&APPID=8e11f356c400d9ab531668301176322e");

$objJSON = json_decode($json); // lo convertimos de json a un tipo de objeto PHP

echo '<p>'.$objJSON->coord->lon.'</p>';
echo '<br>';
echo '<p>'.$objJSON->main->temp.'</p>';
