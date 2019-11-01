<?php
if (!session_id()) {
    session_start();
}
require_once "Facebook/autoload.php";
require_once "GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("813424256761-9hpp85rk2nf7mkjscpmuhptnrrteeukp.apps.googleusercontent.com");
$gClient->setClientSecret("lTrPl4f4DK7Q7HsmgHdxO7gB");
$gClient->setApplicationName("Gespro");
$gClient->setRedirectUri("http://localhost:8080/igesproprueba/g-callback.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login  https://www.googleapis.com/auth/plus.profile.emails.read");


$FB = new \Facebook\Facebook([
    'app_id' => '322052192008031',
    'app_secret' => '23066f3c9b001ed6b7b588530f82e944',
    'default_grapg_version' => 'v2.10'
]);

$helper = $FB->getRedirectLoginHelper();
?>