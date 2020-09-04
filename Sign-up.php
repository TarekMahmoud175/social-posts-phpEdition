<?php
require 'back/requires.php';
if (!empty($_SESSION['name'])) {
  header("location: {$config['base_url']}/home.php");
}
?>
<!DOCTYPE html>
<html>
  <head lang="en">
    <title>My Website</title>
    <meta charset="utf-8">
    <?php require_once 'header.php';?>
    <link rel="stylesheet" type="text/css" href="css/sign-up.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse bg-dark">
      <span><a id='brand' class="navbar-brand text-warning" href="<?=$config['base_url']?>">SOCIAL</a></span>
    </nav>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xmd-6 col-xs-6 col-xl-6 col-md-6 col-lg-6 col-sm-6">
          <div class="card">
            <div class="card-header"><h2>Sign up</h2></div>
            <div class="card-block">
              <form id="signUp" method="POST">
                  <div class="form-group">
                    <label for="name"><i class="fa fa-user"> </i> Name:</label>
                    <input id="name" autocomplete="off" placeholder="Enter Your Name" class="form-control" type="name" name="name">
                    <p id="errormsg" class="text-danger" data='name'></p>
                  </div>
                  <div class="form-group">
                    <label for="mobile"><i class="fa fa-mobile"></i> Mobile:</label>
                    <input id="mobile" autocomplete="off" placeholder="Enter Your Mobile" class="form-control" type="mobile" name="mobile">
                    <p id="errormsg" class="text-danger" data='mobile'></p>
                  </div>
                  <div class="form-group">
                    <label for="email"><i class="fa fa-envelope"> </i> E-mail:</label>
                    <input id="email" autocomplete="off" placeholder="Enter Your E-mail" class="form-control" type="email" name="email">
                    <p id="errormsg" class="text-danger" data='email'></p>
                  </div>
                  <div class="form-group">
                    <label for="pass"><i class="fa fa-key"> </i> Password:</label>
                    <input id="pass" autocomplete="off" placeholder="Enter Your Password" class="form-control" type="password" name="password">
                    <p id="errormsg" class="text-danger" data='password'></p>
                  </div>
                  <div class="form-group">
                    <label for="re-pass"><i class="fa fa-key"> </i> RE-password:</label>
                    <input id="re-pass" autocomplete="off" placeholder="Re-Enter Your Password" class="form-control" type="password" name="repassword">
                    <p id="errormsg" class="text-danger" data='repassword'></p>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-warning"><i class="fa fa-paper-plane"></i> Sign Up</button>
                  </div>
                  <div class="form-group">
                    <p class="text-success" id="successmsg"></p>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript"src="js/sign-up.js"></script>
    <script type="text/javascript" src="js/requests.js"></script>
  </body>
</html>
