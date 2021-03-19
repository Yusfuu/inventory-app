<?php

header('Access-Control-Allow-Origin: *');

if (isset($_POST['id']) && !empty($_POST['id'])) {
  require_once './config.php';

  $id = $_POST['id'];

  $query = "SELECT * FROM product WHERE id = '$id';";

  $result = mysqli_query($link, $query);

  $row = mysqli_fetch_assoc($result);

  $response = json_encode(array("response" => $row));

  echo $response;
} else {
  exit;
}
