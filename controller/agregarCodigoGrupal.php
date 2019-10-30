<?php

if(isset($_POST['nuevoCodigoGrupal'])){
    include_once 'validaciones.php';
    $codGrupo = $_POST['ncg'];
    $CGVacio = camposVacios($codGrupo);

    if($CGVacio == true){

        header('location:../view/grupoProyecto.php'); // campo vacio
    }else{
        include_once '../model/usuarios.php';
        $usuario = new Usuarios();
        session_start();
        $idUsuario = $_SESSION['idUsuario'];
        $usuario->insertarCodigoGrupalUsuario($codGrupo, $idUsuario);
        header('location:../view/grupoProyecto.php'); // fin acciones
    }

}else{
    
    header('location:../view/dashboard.php'); // entrada no autorizada
}
