<?php
require_once 'requires.php';
$conn = connection();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email                = $_POST['email'];
  $password             = $_POST["password"];
  $error                = [];
  $error['email']       = [];
  $error['password']    = [];
  $error['credentials'] = [];
  $row                  = [];
  $val                  = new signIn();
  $val->checkingLoginData($email, $password, $error, $row);
  if (count($error['email']) >= 1
    || count($error['password']) >= 1
    || count($error['credentials']) >= 1) {
    die(json_encode([
      "status" => "error",
      "error"  => $error,
    ]));
  } else {
    $_SESSION['id']     = $row['user_id'];
    $_SESSION['name']   = $row['name'];
    $_SESSION['email']  = $row['email'];
    $_SESSION['mobile'] = $row['mobile'];
    die(json_encode([
      "status" => "success",
      "link"   => $config['base_url'] . "/home.php",
    ]));
  }
}
