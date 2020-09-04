<?php
require 'back/requires.php';
require_once 'back/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id'                => '2556103948043179', // Replace {app-id} with your app id
  'app_secret'            => '0eb8f440e75b11b87866c20153f723de',
  'default_graph_version' => 'v3.2',
]);
$helper      = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl    = "http://localhost:1750/back/callback.php";
$loginUrl    = $helper->getLoginUrl($loginUrl, $permissions);
if (!empty($_SESSION['name'])) {
  header("location: {$config['base_url']}/home.php");
} else {
  ?>
<!DOCTYPE html>
<html>
  <head lang="en">
    <title>My Website</title>
    <meta charset="utf-8">
    <?php require_once 'header.php';?>
    <link rel="stylesheet" type="text/css" href="css/sign-in.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse bg-dark">
      <span><a id='brand' class="navbar-brand text-warning" href="<?=$config['base_url']?>">SOCIAL</a></span>
    </nav>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header"><h2>Sign In</h2></div>
            <div class="card-block">
              <form id="signIn" method="POST">
                <div class="form-group">
                  <label for="email"><i class="fa fa-envelope"> </i> E-mail:</label>
                  <input id="email" autocomplete="off" placeholder="Enter Your E-mail" class="form-control" type="email" name="email">
                  <p class="text-danger" id="errormsg" data="email"></p>
                  <p class="text-danger" id="errormsg" data="credentials"></p>
                </div>
                <div class="form-group">
                  <label for="pass"><i class="fa fa-key"> </i> Password:</label>
                  <input id="pass" autocomplete="off" placeholder="Enter Your Password" class="form-control" type="password" name="password">
                  <p class="text-danger" id="errormsg" data="password"></p>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-outline-warning" id="social"><i class="fa fa-paper-plane"></i> Login</button>
                </div>
              </form>
              <div class="form-group">
                <a href="<?=htmlspecialchars($loginUrl)?>"><button class="btn btn-outline-primary"><i class="fa fa-facebook"></i> Login with Facebook</button></a>
              </div>
              <div class="form-group">
                 <a href="<?=$config['base_url']?>/forget-password.php" class="text-warning"><b>forget password</b></a>
              </div>
              <div class="form-group">
                 <span>don't have account ? </span>
                 <a href="<?=$config['base_url']?>/sign-up.php" class="text-warning"><b>sign up</b></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sign-in.js"></script>
    <script type="text/javascript" src="js/requests.js"></script>
  </body>
</html>
<?php }?>
