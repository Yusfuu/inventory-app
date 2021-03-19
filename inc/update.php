<?php

header('Access-Control-Allow-Origin: *');
require_once './config.php';
require_once './auth.php';

$id = mysqli_real_escape_string($link, $_POST['id']);
$name = mysqli_real_escape_string($link, $_POST['name']);
$desc = mysqli_real_escape_string($link, $_POST['desc']);
$price = mysqli_real_escape_string($link, $_POST['price']);
$quantity = mysqli_real_escape_string($link,  $_POST['quantity']);


$query = "UPDATE product SET name = '$name', description = '$desc', price = '$price', quantity = '$quantity' WHERE id = '$id';";
$result = mysqli_query($link, $query);
print_r(json_encode(array("response" => true)));
