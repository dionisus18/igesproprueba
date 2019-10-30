<?php

if (isset($_POST['comentario'])) {
    include_once 'validaciones.php';
    session_start();
    $idUsuario = $_SESSION['idUsuario'];
    $idProyecto = $_SESSION['idProyecto'];
    $permiso = usuarioProyecto($idUsuario, $idProyecto);
    if ($permiso == true) :

        $comentario = $_POST['TAC'];
        include_once '../model/tareas.php';
        $tareas = new Tareas();
        $idTarea = $_SESSION['idTarea'];

        $tareas->agregarComentario($idTarea, $comentario);
        header('location:../view/detalleTareas.php');
    else :
        header('location:../view/detalleTareas.php'); // sin permisos
    endif;
} else {
    header('location:../view/Dashboard.php');
}
