<?php // TODO: CSRF protection

// load dropbox sdk
require_once(__DIR__.'/../assets/apps/dropbox-sdk/Dropbox/autoload.php');
use \Dropbox as dbx;

// dropbox app config (key/secret)
$argAppInfoFile = __DIR__.'/../content/dropbox.app';

// dropbox request token
$argAuthFileOutput = __DIR__.'/../content/dropbox.auth';

// load dropbox app config
list($appInfoJson, $appInfo) = dbx\AppInfo::loadFromJsonFileWithRaw($argAppInfoFile);

// initialize authorization step 2
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "axsynccontrolcenter", "en");

// retrieve request param
$authCode = $_POST['code']; if($authCode==null || trim($authCode)==='') die('Error: Authorization code missing');

// retrieve request token
list($accessToken, $userId) = $webAuth->finish($authCode);

// debug
echo nl2br("Authorization complete.\n");
echo nl2br("- User ID: $userId\n");
echo nl2br("- Access Token: $accessToken\n");

// setup auth disk storage
$authArr = array(
  "access_token" => $accessToken,
);

// retrieve host config 
if (array_key_exists('host', $appInfoJson)) {
  $authArr['host'] = $appInfoJson['host'];
}

// configure output helper
$json_options = 0;
if (defined('JSON_PRETTY_PRINT')) {
  $json_options |= JSON_PRETTY_PRINT;  // Supported in PHP 5.4+
}

// write token to disk
$json = json_encode($authArr, $json_options);
if (file_put_contents($argAuthFileOutput, $json) !== false) {
  echo "Saved authorization information to \"$argAuthFileOutput\".\n";
} else {
  fwrite(STDERR, "Error saving to \"$argAuthFileOutput\".\n");
  fwrite(STDERR, "Dumping to stderr instead:\n");
  fwrite(STDERR, $json);
  fwrite(STDERR, "\n");
  die;
}