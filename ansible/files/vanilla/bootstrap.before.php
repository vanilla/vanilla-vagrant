<?php
/**
 * This file will make Vanilla use a different config depending on which site you're on.
 * Drop this file into your /conf folder.
 */

if (isset($_SERVER['REQUEST_URI'])) {
    $hostParts = explode('/', $_SERVER['REQUEST_URI']);
    if (count($hostParts) < 2) {
        echo "Wrong url format.";
        die();
    }
    $site = $hostParts[1];
}
// Use a config specific to the site.
$configPath = PATH_ROOT."/conf/$site-conf.php";
define('PATH_CONF_DEFAULT', $configPath);
if (!defined('CLIENT_NAME')) {
    define('CLIENT_NAME', $_SERVER['HTTP_HOST']."_${site}");
}
