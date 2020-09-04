<?php
require 'requires.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //get data from form
  $name       = $_POST['name'];
  $email      = $_POST['email'];
  $mobile     = $_POST['mobile'];
  $password   = $_POST['password'];
  $repassword = $_POST['repassword'];
  //define errors
  $errors               = [];
  $errors['name']       = [];
  $errors['email']      = [];
  $errors['mobile']     = [];
  $errors['password']   = [];
  $errors['repassword'] = [];

  $conn                 = connection();
  $validation           = new validation();
  $errors['name']       = $validation->nameValidation($name);
  $errors['mobile']     = $validation->mobileValidation($mobile);
  $errors['email']      = $validation->emailValidation($email);
  $errors['password']   = $validation->passwordValidation($password);
  $errors['repassword'] = $validation->repasswordValidation($password, $repassword);

  //make response
  if (count($errors['name']) > 0
    || count($errors['mobile']) > 0
    || count($errors['email']) > 0
    || count($errors['password']) > 0
    || count($errors['repassword']) > 0) {

    die(json_encode([
      'status' => 'error',
      'errors' => $errors,
      'msg'    => "request success",
    ]));
  } else {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql             = "INSERT INTO registers (name, email, mobile,password)
       VALUES ('$name','$email','$mobile','$hashed_password')";
    $conn = connection();
    if (mysqli_query($conn, $sql)) {
      mysqli_close($conn);
      die(json_encode([
        'status'   => 'success',
        'msg'      => 'regesteration has been done',
        'link'     => $config['base_url'] . "/sign-in.php",
        'password' => $password,
      ]));
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}
