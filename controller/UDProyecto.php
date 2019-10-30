<?php

if(isset($_POST['modificarProyecto'])){

include_once 'validaciones.php';
$nombreProyecto = $_POST['nombreProyecto'];
$codigoGrupo = $_POST['codigoGrupo'];

$nombreVacio = camposVacios($nombreProyecto);

if($nombreVacio == true):
    header('location:../view/proyecto.php'); // ingreso campos vacios
else:
    include_once '../model/proyectos.php';
    $proyectos = new proyectos();
    session_start();
    $idProyecto = $_SESSION['idProyecto'];
    $detalleProyecto = $proyectos->getProyectoInfo($idProyecto);
    
    foreach($detalleProyecto as $dp){
        $CGactual = $dp['codigoGrupo'];
        $nameActual = $dp['name'];
        $owner = $dp['proyOwner'];
    }

    $idUsuario = $_SESSION['idUsuario'];
    if($owner == $idUsuario){
        //modificar nombre
        if($nombreProyecto != $nameActual){
            $proyectos->modificarNombre($idProyecto,$nombreProyecto);
        }else{
            header('location:../view/proyecto.php'); // mismo nombre, no ejecutar accion
        }

        if($CGactual != $codigoGrupo){
            $proyectos->insertarCodigoGrupo($idProyecto, $codigoGrupo);
        }else{
            header('location:../view/proyecto.php'); // mismo codigo de grupo, no ejecutar accion
        }

    }else{
        header('location:../view/proyecto.php'); // ingreso campos vacios
    }

    

    header('location:../view/proyecto.php'); // fin acciones
    
endif;




}else if(isset($_POST['eliminarProyecto'])){

    include_once '../model/proyectos.php';
    $proyectos = new proyectos();
    session_start();
    $idProyecto = $_SESSION['idProyecto'];
    $detalleProyecto = $proyectos->getProyectoInfo($idProyecto);

    foreach($detalleProyecto as $dp){
        $owner = $dp['proyOwner'];
        $totalTareas = $dp['tareasProyecto'];
    }

    $idUsuario = $_SESSION['idUsuario'];
    if($owner == $idUsuario && $totalTareas == 0){
        include_once '../model/usuarios.php';
        $usuario = new Usuarios();
        $usuario->eliminarProyectoUsuario($idProyecto,$idUsuario); //debo incluir a los otros integrantes
        $proyectos->eliminarProyecto($idProyecto);
        header('location:../view/dashboard.php'); //Proyecto Eliminado
    }else{
        header('location:../view/proyecto.php'); // sin permisos o aun tiene tareas el proyecto
    }


}else{
    header('location:../view/dashboard.php'); //entro a la fuerza
}



?>