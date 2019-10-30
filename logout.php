<?php
require_once "config.php";
unset($_SESSION['idUsuario']);
$gClient->revokeToken();
session_destroy();
header('Location: index.php');
exit();
?>