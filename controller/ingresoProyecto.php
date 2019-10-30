<?php
session_start();

$_SESSION['idProyecto'] = $_GET['idProyecto'];

header('location:../view/proyecto.php');

?>