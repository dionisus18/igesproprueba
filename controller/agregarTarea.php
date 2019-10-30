<?php

if (isset($_POST['nombreTarea']) && isset($_POST['listResponsables']) && isset($_POST['listTipoTarea']) && isset($_POST['fechaEntrega']) && isset($_POST['horasTareas'])) {

    include_once 'validaciones.php';


    $name = $_POST['nombreTarea'];
    $responsable = $_POST['listResponsables'];
    $tipoTarea = $_POST['listTipoTarea'];
    $fechaEntrega = $_POST['fechaEntrega'];
    $horasAsignadas = $_POST['horasTareas'];

    $campoVacio = camposVacios($name);
    if ($campoVacio == true) {
        header('location:../view/nuevaTarea.php');
    } else {
        $campoVacio = camposVacios($fechaEntrega);
        $date = date('Y-m-d');
        if ($campoVacio == true || $fechaEntrega < $date) {
            header('location:../view/nuevaTarea.php');
        } else {
            $campoVacio = camposVacios($horasAsignadas);
            $numerico = is_numeric($horasAsignadas);
            if ($numerico == true) {
                $int = true;
                if ($numerico <= 0) {
                    $int = false;
                }
            } else {
                $int = false;
            }
            if ($campoVacio == true || $int == false) {
                header('location:../view/nuevaTarea.php');
            } else {

                include_once '../model/tareas.php';

                $tareas = new Tareas();
                session_start();
                $idProyecto = $_SESSION['idProyecto'];
                $idUsuario = $_SESSION['idUsuario'];

                $permiso = usuarioProyecto($idUsuario, $idProyecto);
                if ($permiso == true) :
                    $tareas->insertarTarea($name, $idProyecto, $responsable, $tipoTarea, $fechaEntrega, $horasAsignadas, $idUsuario);
                    header('location:../view/proyecto.php');
                else :
                    header('location:../view/proyecto.php'); // no tiene permisos
                endif;
            }
        }
    }
} else {
    header('location:../view/proyecto.php');
}
