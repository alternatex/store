<?php // TODO: CSRF protection

// load dropbox sdk
require_once(__DIR__.'/../assets/apps/dropbox-sdk/Dropbox/autoload.php');
use \Dropbox as dbx;

// dropbox app config (key/secret)
$argAppInfoFile = __DIR__.'/../content/dropbox.app';

// load dropbox app config
list($appInfoJson, $appInfo) = dbx\AppInfo::loadFromJsonFileWithRaw($argAppInfoFile);

// initialize authorization
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "dropboxapp", "en");  
$authorizeUrl = $webAuth->start();

// shout out loud
echo nl2br("App: \n\t Key:".$appInfo->getKey()."\n\tSecret: ".$appInfo->getSecret()."\n");
echo nl2br("1. Go to: <a target=\"_blank\" href=\"$authorizeUrl\">$authorizeUrl</a>\n");
echo nl2br("2. Click \"Allow\" (you might have to log in first).\n");
echo nl2br("3. Copy the authorization code.\n");
?>
<form action="approve.php" method="post">
    <label for="code">Code</label>
  <input type="password" name="code"/>
  <button>approve</button>
</form>