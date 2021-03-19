<?php

header('Access-Control-Allow-Origin: *');
require_once './config.php';

$query = "SELECT * FROM product;";

$result = mysqli_query($link, $query);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$response = json_encode(array("response" => $rows));

echo $response;