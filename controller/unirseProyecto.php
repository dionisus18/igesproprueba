<?php

include_once '../model/proyectos.php';
include_once '../model/usuarios.php';
$usuario = new Usuarios();
$proyecto = new proyectos();

$codProyecto = $_POST['Ucod'];

$infoProyecto = $proyecto->getProyectoID($codProyecto);

if(is_null($infoProyecto)){
    echo '<script languaje="javascript">';
    echo 'alert("El proyecto al que te quieres unir no existe");';
    echo 'window.location.href="../view/nuevoProyecto.php";';
    echo '</script>';
}else{
    session_start();
    $idProyecto = $infoProyecto['_id'];
    $idUsuario = $_SESSION['idUsuario'];

    $usuario->insertarProyectoUsuario($idProyecto,$idUsuario);
    $proyecto->insertarUsuarioProyecto($idUsuario,$idProyecto);

    header('location:../view/dashboard.php');
}

?>