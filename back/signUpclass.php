<?php
class validation
{
  public function nameValidation($name)
  {
    $errors         = [];
    $errors['name'] = [];
    if (empty($name)) {
      $errors['name'][] = 'please enter your name';
    }
    if (isset($name)) {
      if (strlen($name) < 3 && !empty($name)) {
        $errors['name'][] = 'Name cannot be less than three letters';
      }
      if ((!preg_match("/^[a-zA-Z ]*$/", $name)) && !empty($name)) {
        $errors['name'][] = "Only letters and white space allowed";
      }
    }
    return $errors['name'];
  }
  public function emailValidation($email)
  {
    $conn            = connection();
    $errors          = [];
    $errors['email'] = [];
    if (empty($email)) {
      $errors['email'][] = 'please enter your email';
    }
    if (isset($email)) {
      if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && !empty($email)) {
        $errors['email'][] = "Invalid email format";
      }
      $sql    = "SELECT * FROM registers WHERE  email='$email'";
      $result = mysqli_query($conn, $sql);
      if ($result->num_rows >= 1 && !empty($email)) {
        $errors['email'][] = "This email already exist";
      }
    }
    return $errors['email'];
  }
  public function mobileValidation($mobile)
  {
    $conn             = connection();
    $errors           = [];
    $errors['mobile'] = [];
    if (empty($mobile)) {
      $errors['mobile'][] = 'please enter your mobile number';
    }
    if (isset($mobile)) {
      if (strlen($mobile) != 11 && !empty($mobile)) {
        $errors['mobile'][] = 'mobile must be 11 number';
      }
      if ((!preg_match('/^01[0-9]{9}+$/', $mobile)) && !empty($mobile)) {
        $errors['mobile'][] = 'please enter only numbers and start with 01';
      }
      $sql    = "SELECT * FROM registers WHERE  mobile='$mobile'";
      $result = mysqli_query($conn, $sql);
      if ($result->num_rows >= 1 && !empty($mobile)) {
        $errors['mobile'][] = "This mobile already exist";
      }
    }
    return $errors['mobile'];
  }
  public function passwordValidation($password)
  {
    $errors             = [];
    $errors['password'] = [];
    if (empty($password)) {
      $errors['password'][] = 'please create your password';
    }
    if (isset($password)) {
      if (strlen($password) < 8 && !empty($password)) {
        $errors['password'][] = 'your password cannot be less than 8 characters';
      }
      if ((!preg_match("#[0-9]+#", $password)) && !empty($password)) {
        $errors['password'][] = "Your Password Must Contain At Least 1 Number!";
      }
      if ((!preg_match("#[A-Z]+#", $password)) && !empty($password)) {
        $errors['password'][] = "Your Password Must Contain At Least 1 Capital Letter!";
      }
      if ((!preg_match("#[a-z]+#", $password)) && !empty($password)) {
        $errors['password'][] = "Your Password Must Contain At Least 1 Lowercase Letter!";
      }
    }
    return $errors['password'];
  }
  public function repasswordValidation($password, $repassword)
  {
    $errors               = [];
    $errors['repassword'] = [];
    if (empty($repassword)) {
      $errors['repassword'][] = 'please re-enter your password';
    }
    if (isset($repassword)) {
      if (($repassword != $password) && !empty($repassword)) {
        $errors['repassword'][] = 'please enter your password correctly';
      }
    }
    return $errors['repassword'];
  }
}
