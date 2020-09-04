<?php
require_once 'requires.php';
require_once 'Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id'                => '2556103948043179', // Replace {app-id} with your app id
  'app_secret'            => '0eb8f440e75b11b87866c20153f723de',
  'default_graph_version' => 'v3.2',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (!isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('2556103948043179'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (!$accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
// header('Location: index.php');

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $_SESSION['fb_access_token']);
} catch (Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
// ==========================================================================================================
$zone = date_default_timezone_get();
date_default_timezone_set($zone);
$user            = $response->getGraphUser();
$name            = $user['name'];
$email           = $user['email'];
$fb_id           = $user['id'];
$created_at      = date("Y-m-d  h:i:s");
$token           = $_SESSION['fb_access_token'];
$hashed_password = password_hash($token, PASSWORD_BCRYPT);
$conn            = connection();
$_SESSION['name']  = $name;
$_SESSION['email'] = $email;
$_SESSION['fb_id'] = $fb_id;
// ===============================================================================================================
function fb_user($conn, $name, $email, $hashed_password, $created_at, $fb_id)
{
  $sql    = "SELECT * FROM registers WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows == 1) {
    $sql2    = "UPDATE registers SET password='$hashed_password' where email ='$email'";
    $result2 = mysqli_query($conn, $sql2);
  } else if ($result->num_rows == 0) {
    $sql = "INSERT INTO
    registers (name, email,password,facebook_id,created_at)
       VALUES ('$name','$email','$hashed_password','$fb_id','$created_at')";
    $result = mysqli_query($conn, $sql);
  }
  $sql3    = "SELECT DISTINCT user_id FROM registers WHERE email= '$email'";
  $result3 = mysqli_query($conn, $sql3);
  if ($result3->num_rows >= 1) {
    $row            = mysqli_fetch_assoc($result3);
    $_SESSION['id'] = $row['user_id'];
    mysqli_close($conn);
  }
  return $_SESSION['id'];
}
// =============================================================================================================
$_SESSION['id'] = fb_user($conn, $name, $email, $hashed_password, $created_at, $fb_id);

header("location:{$config['base_url']}/home.php");
