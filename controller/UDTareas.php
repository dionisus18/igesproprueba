<?php

if (isset($_POST['modificarTarea'])) {

    include_once 'validaciones.php';
    $name = $_POST['nombreTarea'];
    $responsableTarea = $_POST['responsableTarea'];
    $fechaEntrega = $_POST['fechaEntrega'];
    $horasAsignadas = $_POST['horasAsignadas'];
    $horasReales = $_POST['horasReales'];

    $nameVacio = camposVacios($name);
    $responsableVacio = camposVacios($responsableTarea);
    $FEVacio = camposVacios($fechaEntrega);
    $HAVacio = camposVacios($horasAsignadas);
    $HRVacio = camposVacios($horasReales);
    if ($nameVacio == true || $responsableVacio == true || $FEVacio == true) :
        header('location:../view/detalleTareas.php'); //campos vacios
    else :
        if ($HAVacio == true) {
            $horasAsignadas = 0;
        }
        if ($HRVacio == true) {
            $horasReales = 0;
        }

        include_once '../model/tareas.php';
        $tareas = new Tareas();
        session_start();
        $idTarea = $_SESSION['idTarea'];
        $idUsuario = $_SESSION['idUsuario'];
        $permiso = $tareas->getDetalleTarea($idTarea);

        include_once '../model/proyectos.php';
        $proy = new proyectos();
        $idProyecto = $_SESSION['idProyecto'];
        $admin = $proy->getProyectoInfo($idProyecto);

        foreach ($admin as $a) {
            $proyOwner = $a['proyOwner'];
        }

        $dbName = $permiso['name'];
        $dbRT = $permiso['responsable'];
        $dbFE = $permiso['fechaEntrega'];
        $dbHA = $permiso['horasAsignadas'];
        $dbHR = $permiso['horasReales'];


        //modifica nombre tarea
        if (($dbName != $name && $permiso['owner'] == $idUsuario) || ($dbName != $name && $proyOwner == $idUsuario)) {

            $tareas->modificarTarea($idTarea, $name, $dbRT, $dbFE, $dbHA, $dbHR);
        }


        //modifica responsable tarea
        if (($dbRT != $responsableTarea && $permiso['owner'] == $idUsuario) || ($dbRT != $responsableTarea && $proyOwner == $idUsuario)) {

            $tareas->modificarTarea($idTarea, $dbName, $responsableTarea, $dbFE, $dbHA, $dbHR);
        }

        //modifica fecha de entrega
        $date = date('Y-m-d');
        if (($dbFE != $fechaEntrega && $permiso['owner'] == $idUsuario &&  $fechaEntrega >= $date) || ($dbFE != $fechaEntrega && $proyOwner == $idUsuario &&  $fechaEntrega >= $date)) {

            $tareas->modificarTarea($idTarea, $dbName, $dbRT, $fechaEntrega, $dbHA, $dbHR);
        }
        //modifica horas asignadas
        if (($dbHA != $horasAsignadas && $permiso['owner'] == $idUsuario && is_numeric($horasAsignadas)) || ($dbHA != $horasAsignadas && $proyOwner == $idUsuario && is_numeric($horasAsignadas))) {
            if ($horasAsignadas > 0) {
                $tareas->modificarTarea($idTarea, $dbName, $dbRT, $dbFE, $horasAsignadas, $dbHR);
            } else {
                header('location:../view/detalleTareas.php'); //numero negativo
            }
        }
        //modifica horas reales
        if (($dbHR != $horasReales && $permiso['owner'] == $idUsuario && is_numeric($horasReales)) || ($dbHR != $horasReales && $proyOwner == $idUsuario && is_numeric($horasReales))) {
            if ($horasReales >= 0) {
                $tareas->modificarTarea($idTarea, $dbName, $dbRT, $dbFE, $dbHA, $horasReales);
            } else {
                header('location:../view/detalleTareas.php'); //numero negativo
            }
        }

        header('location:../view/detalleTareas.php'); //finalizar
    endif;
} else if (isset($_POST['eliminarTarea'])) {

    include_once '../model/tareas.php';

    $tareas = new Tareas();
    session_start();
    $idTarea = $_SESSION['idTarea'];
    $idUsuario = $_SESSION['idUsuario'];
    $permiso = $tareas->getDetalleTarea($idTarea);

    include_once '../model/proyectos.php';
    $proy = new proyectos();
    $idProyecto = $_SESSION['idProyecto'];
    $admin = $proy->getProyectoInfo($idProyecto);

    foreach ($admin as $a) {
        $proyOwner = $a['proyOwner'];
    }

    if ($permiso['owner'] == $idUsuario || $proyOwner == $idUsuario) {
        $tareas->eliminarTarea($idTarea);
        header('location:../view/proyecto.php');
    } else {
        header('location:../view/detalleTareas.php'); //no tiene permisos
    }
} else {
    header('location:../view/dashboard.php');
}
