<?php
require_once 'requires.php';

$button=$_GET['name'];
function signInClick($config)
{
    die(json_encode([
      'link' =>$config['base_url'].'/sign-in.php',
    ]));
}
function signUpClick($config)
{
    die(json_encode([
      'link' =>$config['base_url'].'/sign-up.php',
    ]));
}


switch ($button) {
  case 'signin':
    signInClick($config);
    break;
  case 'signup':
   signUpClick($config);
    break;

}
