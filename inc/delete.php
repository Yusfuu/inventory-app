<?php

header('Access-Control-Allow-Origin: *');
require_once './config.php';

$id = $_POST['id'];
$file = $_POST['file'];

$query = "DELETE FROM product WHERE id = '$id';";

$result = mysqli_query($link, $query);



unlink("../uploads/" . $file);

$response = json_encode(array("response" => true));

echo $response;
