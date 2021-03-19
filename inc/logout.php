<?php

if (!empty($_POST['logout']) && $_POST['logout'] == true) {
  session_start();
  session_unset();
  session_destroy();
  echo json_encode(array("response" => "logout"));
} else {
  header("Location: http://localhost/inventory/login");
  exit;
}
