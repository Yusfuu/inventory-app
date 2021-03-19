<?php

header('Access-Control-Allow-Origin: *');

if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_FILES["file"])) {

  require_once './config.php';
  require_once './auth.php';


  $name = mysqli_real_escape_string($link, $_POST['name']);
  $desc = mysqli_real_escape_string($link, $_POST['desc']);
  $price = mysqli_real_escape_string($link, $_POST['price']);
  $quantity = mysqli_real_escape_string($link,  $_POST['quantity']);

  if ($_FILES['file']['size'] > 1000000) {
    echo json_encode(array("message" => "Exceeded filesize limit."));
    exit;
  }

  $fileNameCmps = explode(".", $_FILES["file"]["name"]);
  $fileExtension = strtolower(end($fileNameCmps));

  if (in_array($fileExtension, array('jpg', 'png'))) {
    $uniqid =  uniqid() . "." . time() . "." . $fileExtension;
    $target_file = "../uploads/" . $uniqid;
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      $query = "INSERT INTO product(employee_id, name, description, price, quantity, product_img_url) VALUES ($id,'$name','$desc','$price','$quantity','$uniqid');";
      $result = mysqli_query($link, $query);
      echo json_encode(array("message" => "done"));
      exit;
    } else {
      echo json_encode(array("message" => "Ooops!, There was some error"));
      exit;
    }
  } else {
    echo json_encode(array("message" => "file type not allowed"));
    exit;
  }
} else {
  header("Location: http://localhost/inventory/login");
  exit;
}
