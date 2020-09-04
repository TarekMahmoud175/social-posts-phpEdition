<?php
require_once 'back/requires.php';
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
  <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
  <!-- NAVBAR -->
    <nav class="navbar navbar-inverse bg-dark">
      <span><a id='brand'class="navbar-brand text-warning" href="<?=$config['base_url']?>">SOCIAL</a></span>
      <div class="navbar-btn navbar-right">
          <a class="text-warning"  id="signin"><button class="btn btn-outline-warning" >sign in</button></a>
          <a class="text-warning"  id="signup"><button class="btn btn-outline-warning" >sign up</button></a>
      </div>
    </nav>
  <div class="container-fluid">
    <div class="row" id="firstrow">
      <div class="col-md-12 col-sm-12 col-lg-12">
      </div>
    </div>
  </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active" id="firstSlide">
                <div class="container d-block w-100">
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <h1 class="text-warning"> THIS IS YOUR WINDOW TO THE WORLD</h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item" id="secondSlide">
                <div class="container d-block w-100">
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <h1 class="text-warning"> THE WORLD IN YOUR HAND</h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container d-block w-100" id="thirdSlide">
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <h1 class="text-warning"> JUST SIGN IN AND GET IN TOUCH WITH OTHERS</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/indexjs.js"></script>
  <script type="text/javascript" src="js/requests.js"></script>
</body>
</html>
