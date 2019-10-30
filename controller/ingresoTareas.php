<?php
session_start();

$_SESSION['idTarea'] = $_GET['idTarea'];


header('location:../view/detalleTareas.php');

?>