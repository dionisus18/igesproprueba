<?php
$inactive = 2400;

if (!isset($_SESSION['idUsuario'])) {
    header('Location: ../index.php');
    exit();
}
if(isset($_SESSION['userTime']) && (time() - $_SESSION['userTime'] > $inactive)){
    unset($_SESSION['userTime']);
    unset($_SESSION['idUsuario']);
    session_destroy();
    header('Location: ../index.php');
}
$_SESSION['userTime'] = time();
?>
