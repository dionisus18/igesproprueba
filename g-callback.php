<?php
require_once "config.php";
if (isset($_SESSION['idUsuario']))
$gClient->setAccessToken($_SESSION['idUsuario']);
else if (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['idUsuario'] = $token;
}else{
    header('Location: index.php');
    exit();
}
$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_me->get();
$_SESSION['Gid'] = $userData['id'];
$_SESSION['Gemail'] = $userData['email'];
$_SESSION['Gpicture'] = $userData['picture'];
$_SESSION['GfamilyName'] = $userData['familyName'];
$_SESSION['GgivenName'] = $userData['givenName'];


header('Location: view/dashboard.php');
/*
require_once '../src/model/usuarios.php';
$usuario = new Usuarios();

$GoogleMail = $userData['email'];
$GoogleName = $userData['givenName'];
$GooglePass = "";

$infoUsuario = $usuario->findUsuario($GoogleMail);

if(is_null($infoUsuario)){
    $usuario->insertarUsuarios($GoogleName,$GoogleMail,$GooglePass);
    header('Location: view/dashboard.php');
    exit();
}else{
    header('Location: view/dashboard.php');
    exit();
}
*/

    

?>

