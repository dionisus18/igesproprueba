<?php

if (isset($_POST['nombreProyecto']) && isset($_POST['codProyecto'])) {
    include_once 'validaciones.php';
    $name = $_POST['nombreProyecto'];
    $codProyecto = $_POST['codProyecto'];

    $campoVacio = camposVacios($name);
    if ($campoVacio == true) {
        header('location:../view/nuevoProyecto.php');
    } else {
        $campoVacio = camposVacios($codProyecto);
        if ($campoVacio == true) {
            header('location:../view/nuevoProyecto.php');
        } else {


            include_once '../model/proyectos.php';
            include_once '../model/usuarios.php';
            $usuarios = new Usuarios();
            $proyectos = new proyectos();


            session_start();
            $idUsuario = $_SESSION['idUsuario'];

            $validarCodigo = $proyectos->getProyectoID($codProyecto);

            if (is_null($validarCodigo)) {

                $proyectos->insertarProyecto($name, $codProyecto,$idUsuario);
                $infoProyecto = $proyectos->getProyectoID($codProyecto);

                $idProyecto = $infoProyecto['_id'];
                $usuarios->insertarProyectoUsuario($idProyecto, $idUsuario);
                $proyectos->insertarUsuarioProyecto($idUsuario, $idProyecto);
                header('location:../view/dashboard.php');
            } else {
                header('location:../view/nuevoProyecto.php'); //codigo de proyecto utilizado
            }
        }
    }
} else {

    header('location:../view/dashboard.php');
}
