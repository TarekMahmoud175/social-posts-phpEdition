<?php
require 'back/requires.php';
$conn = connection();
if (empty($_SESSION['name'])) {
  header("location: {$config['base_url']}");
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <title>Home</title>
  <meta charset="utf-8">
  <?php require_once 'header.php'; ?>
  <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
    <nav class="navbar navbar-inverse bg-dark">
        <span><a id='brand' class="navbar-brand text-warning form-text" href="<?=$config['base_url']?>">SOCIAL</a></span>
          <form class="form-inline" id="search">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
             <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" autocomplete="off">Search</button>
          </form>
          <div class="navbar-right">
            <a class="text-warning" id='home'><button class="btn btn-outline-warning">Home</button></a>
            <a class="text-warning" id="profile"><button class="btn btn-outline-warning"><?=$_SESSION['name']?></button></a>
            <a class="text-warning" id="logout"><button type="submit" class="btn btn-outline-warning">logout</button></a>
          </div>
    </nav>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xmd-6 col-xs-12 col-xl-6 col-md-6 col-lg-6 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h2>Post</h2>
            </div>
            <div class="card-block">
              <form id="postForm" method="POST">
                <div class="form-group">
                  <textarea id="post" name="post"  placeholder="  what are you thinking about!!"></textarea>
                </div>
                <div class="form-group">
                  <a><button class="btn btn-outline-warning"> post </button></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container posts-container">
<?php
require_once 'back/requires.php';
$conn = connection();
$sql  = "SELECT registers.name,registers.user_id , posts.thedate, posts.post, posts.post_id
            FROM posts
            INNER JOIN registers
            ON posts.user_id = registers.user_id
            ORDER BY posts.thedate DESC";
$result = mysqli_query($conn, $sql);
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row['user_id'];
    $name    = $row['name'];
    $post    = $row['post'];
    $date    = $row['thedate'];
    $post_id = $row['post_id'];
    echo '<div class="row justify-content-center">';
    echo '<div class="col-xmd-6 col-xs-12 col-xl-6 col-md-6 col-lg-6 col-sm-12">';
    echo '<div class="card">';
    echo '<div class="card-header post-header">' .
      "<div class='row row-header'>
              <div class=' col-7'>" . "<strong>" . $name . "</strong>" . "</div>" ;
     if($user_id == $_SESSION['id']){
     echo "<div class='col offset-3'>"
              ."<div class='dropdown'>
                       <button type='button' class='btn btn-outline-warning dropdown-toggle' data-toggle='dropdown'>
                       </button>
                      <div class='dropdown-menu'>
                        <a class='dropdown-item edit' data-toggle='modal' data-target='#exampleModalLong'> edit</a>
                        <a class='dropdown-item delete '> delete</a>
                      </div>
                    </div>
                  </div>";
                }
    echo"</div>"."</div>";
    echo '<div class="card-block '.$user_id.'" id="' . $post_id . '">';
    echo "<p class='post-content' >" . str_replace("\n", "<br>", $post) . "</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
}
?>
    </div>
    <?php require_once 'footer.php'; ?>
</body>
</html>
