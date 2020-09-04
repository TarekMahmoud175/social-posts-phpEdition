<?php
require_once 'requires.php';
$conn   = connection();
$Button = $_GET['name'];
// ============================================================================

function brandClick($config)
{
  if (empty($_SESSION)) {
    die(json_encode([
      "empty" => "yes",
      "link"  => $config['base_url'],
    ]));
  } else {
    die(json_encode([
      "empty" => "no",
      "link"  => $config['base_url'] . '/home.php',
    ]));
  }
}
// ============================================================================

function homeClick($config)
{
  if (empty($_SESSION)) {
    die(json_encode([
      "empty" => "yes",
      "link"  => $config['base_url'] . '/sign-in.php',
    ]));
  } else {
    die(json_encode([
      "empty" => "no",
      "link"  => $config['base_url'] . '/home.php',
    ]));
  }
}
// ============================================================================

function profileClick($config)
{
  if (empty($_SESSION)) {
    die(json_encode([
      "empty" => "yes",
      "link"  => $config['base_url'] . '/sign-in.php',
    ]));
  } else {
    die(json_encode([
      "empty" => "no",
      "link"  => $config['base_url'] . '/profile.php',
    ]));
  }
}
// ===========================================================================

function logoutClick($config)
{
  session_unset();
  session_destroy();
  if (empty($_SESSION)) {
    die(json_encode([
      "empty" => "yes",
      "link"  => $config['base_url'] . '/sign-in.php',
    ]));
  }
}
// ============================================================================
function postClick($conn)
{
  if (!empty($_GET['post'])) {
    $id   = $_SESSION["id"];
    $post = $_GET['post'];
    $zone = date_default_timezone_get();
    date_default_timezone_set($zone);
    $date = date("Y-m-d  h:i:s");
    $sql  = "INSERT INTO posts (post,thedate,user_id)
          VALUES('$post','$date','$id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $sql_get = "SELECT registers.name ,registers.user_id, posts.post_id
            FROM posts
            INNER JOIN registers
            on (posts.user_id = registers.user_id
                and posts.post ='$post')";
      $result_get = mysqli_query($conn, $sql_get);
      if ($result_get) {
        while ($row = mysqli_fetch_assoc($result_get)) {
          $user_id = $row['user_id'];
          $post_id = $row['post_id'];
          $name    = $row['name'];
        }
        die(json_encode([
          "status"  => "success",
          "post"    => $post,
          "post_id" => $post_id,
          "user_id" => $user_id,
          "name"    => $_SESSION['name'],
        ]));
      }
    }
  } else {
    die(json_encode([
      "status" => "error",
      "msg"    => "check your connection",
    ]));
  }
}
// ===========================================================================

function deletePost($conn)
{
  $user_id = $_GET['user_id'];
  if ($_SESSION['id'] == $user_id) {
    $post_id = $_GET['post_id'];
    $sql     = "DELETE FROM posts where post_id = '$post_id' ";
    $result  = mysqli_query($conn, $sql);
    if ($result) {
      die(json_encode([
        "status" => "success",
      ]));
    } else {
      die(json_encode([
        "status" => "error",
      ]));
    }
  } else {
    die(json_encode([
      "status" => "fail",
      "msg"    => "you can not delete this post",
    ]));
  }
}
// ============================================================================
function editClick($conn)
{
  $user_id = $_GET['user_id'];
  $post_id = $_GET['post_id'];
  $post    = $_GET['post'];
  $sql     = "UPDATE posts
            SET post = '$post'
            WHERE ( posts.user_id = $user_id  AND  posts.post_id = '$post_id' ) ";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $sql2       = "SELECT post FROM posts where posts.post_id = '$post_id'";
    $result_get = mysqli_query($conn, $sql2);
    if ($result_get) {
      while ($row = mysqli_fetch_assoc($result_get)) {
        $edit_post = $row['post'];
      }
      die(json_encode([
        "status"   => "success",
        "msg"      => "ok",
        "new_post" => $edit_post,
      ]));
    }
  } else {
    die(json_encode([
      "status" => "fail",
      "msg"    => "Try again later",
    ]));
  }
}

// ============================================================================

switch ($Button) {
  case 'home':
    homeClick($config);
    break;
  case 'profile':
    profileClick($config);
    break;
  case 'logout':
    logoutClick($config);
    break;
  case 'brand':
    brandClick($config);
    break;
  case 'post':
    postClick($conn);
    break;
  case 'post-profile':
    postClick($conn);
    break;
  case 'delete':
    deletePost($conn);
    break;
  case 'edit':
    editClick($conn);
    break;
}
