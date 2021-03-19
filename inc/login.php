<?php
header("Access-Control-Allow-Origin: *");
session_start();

$email = $_POST["email"];
$password = $_POST["password"];
if (isset($email) && isset($password) && !empty($email) && !empty($password)) {

  require_once './config.php';

  $email = mysqli_real_escape_string($link, $_POST['email']);
  $password = mysqli_real_escape_string($link, $_POST['password']);

  $query = "SELECT * FROM employee WHERE email = '$email';";
  $result = mysqli_query($link, $query);

  if (!mysqli_num_rows($result)) {
    $message = "The email address you entered doesn't belong to any account.";
    exit(json_encode(array("message" => $message)));
  } else {
    $data = mysqli_fetch_assoc($result);
    if (!password_verify($password, $data["password"])) {
      $message = "Sorry your password was incorrect.";
      exit(json_encode(array("message" => $message)));
    } else {
      $_SESSION["id"] = $data["id"];
      $_SESSION["name"] = $data["name"];
      $_SESSION["email"] = $data["email"];
      $_SESSION["img_url"] = $data["img_url"];
      $_SESSION["login"] = true;
      exit(json_encode(array("message" => true)));
    }
  }
} else {
  header("Location: http://localhost/inventory/login");
  exit;
}
