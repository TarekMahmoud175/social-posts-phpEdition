<?php
  require 'back/config.php';
 ?>
<!DOCTYPE html>
<html>
  <head lang="en">
    <title>Forget password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/forget-password.css">
    <link rel="stylesheet" type="text/css" href="css/mutual.css">

  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a id='brand' class="navbar-brand text-warning" href="<?=$config['base_url'] ?>">SOCIAL</a>
    </nav>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header" id="card-header" ><h2> please type your email </h2></div>
            <div class="card-block"  id="card-block">
              <form id="sign in Form" method="POST">
                <div class="form-group">
                  <label for="email"><i class="fa fa-user "> </i> E-mail:</label>
                  <input type="email" name="email" class="form-control" autocomplete="off" id="email" placeholder="Enter your E-mail" placeholder='Enter your E-mail'>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-outline-warning">send code<i class="fa fa-paper-plane"> </i></button>
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
    <script type="text/javascript"src="js/requests.js"></script>
  </body>
</html>
