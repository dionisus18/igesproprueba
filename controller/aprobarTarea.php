<?php

include_once '../model/tareas.php';
$tarea = new Tareas();
session_start();
$idTarea = $_SESSION['idTarea'];
$idUsuario = $_SESSION['idUsuario'];
$permiso = $tarea->getDetalleTarea($idTarea);

include_once '../model/proyectos.php';
$proy = new proyectos();
$idProyecto = $_SESSION['idProyecto'];
$admin = $proy->getProyectoInfo($idProyecto);

foreach ($admin as $a) {
    $proyOwner = $a['proyOwner'];
}

if ($permiso['estadoTarea'] == 3) {
    header('location:../view/detalleTareas.php'); //la tarea ya estaba aprovada
}else{
    if ($permiso['owner'] == $idUsuario || $proyOwner == $idUsuario) {
        $tarea->aprobarTarea($idTarea);
        header('location:../view/proyecto.php');
    } else {
        header('location:../view/detalleTareas.php'); //no tiene permisos
    }
}


