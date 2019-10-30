<?php

if(isset($_POST['eliminarCG'])){
    include_once 'validaciones.php';
    $codGrupal = $_POST['codigosGrupalesUsuario'];
    $CGVacio = camposVacios($codGrupal);

    if($CGVacio == true){
        
        header('location:../view/grupoProyecto.php'); //campos vacios
    }else{
        include_once '../model/usuarios.php';
        $usuario = new Usuarios();
        session_start();
        $idUsuario = $_SESSION['idUsuario'];
        $usuario->eliminarCodigoGrupalUsuario($codGrupal,$idUsuario);
        header('location:../view/grupoProyecto.php'); //fin acciones
    }

}else{
    header('location:../view/grupoProyecto.php'); //entro sin permisos
}

?>