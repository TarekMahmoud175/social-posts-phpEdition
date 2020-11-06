<?php
function connection()
{
  $servername = "localhost";
  $username   = 'root';
  $password   = "";
  $dbName     = "social";

// Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  return $conn;
}
?>
