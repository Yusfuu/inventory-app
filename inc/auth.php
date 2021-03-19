<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
  header("Location: http://localhost/inventory/login");
  exit;
} else {
  $id =  $_SESSION["id"];
  $name =  $_SESSION["name"];
  $email = $_SESSION["email"];
  $profile_url = $_SESSION["img_url"];
}
