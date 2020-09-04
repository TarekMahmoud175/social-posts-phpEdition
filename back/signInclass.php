<?php
require_once 'requires.php';
class signIn
{
  public function checkingLoginData($email, $password, &$error ,&$row)
  {
    $error                = [];
    $error['email']       = [];
    $error['password']    = [];
    $error['credentials'] = [];
    $conn                 = connection();
    if (empty($email)) {
      $error['email'][] = "E-mail is required";
    }
    if (empty($password)) {
      $error['password'][] = "password is required";
    }
    if (isset($email)
      && isset($password)
      && (!empty($email) && !empty($password))
    ) {
      $sql    = "SELECT * FROM registers WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      if ($result->num_rows >= 1 && (!empty($email)&&!empty($password))) {
        $row = mysqli_fetch_assoc($result);
        if ((!password_verify($password, $row['password']) || $email != $row['email'])
          && (!empty($email) && !empty($password))) {
          $error['credentials'][] = "The credentials you supplied were not correct";
        }
      }else{
        $error['credentials'][] = "The credentials you supplied were not correct";
      }
    }
  }
}
