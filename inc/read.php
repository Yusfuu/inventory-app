<?php

// defined headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// read json data
$data = json_decode(file_get_contents("php://input"), true);
echo json_encode($data);

// link connection
// require_once './config.php';

// $query = 'SELECT * FROM employee';
// $result = mysqli_query($link, $query);

// $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// if (mysqli_num_rows($result)) {
//   echo json_encode(array('response' => $data));
// } else {
//   echo json_encode(array('response' => 404));
// }
