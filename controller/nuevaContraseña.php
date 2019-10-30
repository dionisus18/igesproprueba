<?php 

    if (isset($_POST['email'])) {
        include_once 'validaciones.php';
    
        $email = $_POST['email'];    
        
        $campoVacio = camposVacios($email);
        if ($campoVacio == true) {
            header('location:../mantenimiento.php?mjs=vemail&&ml=x');
        } else {
                include_once '../model/usuarios.php';
                session_start();
                $usuario = new Usuarios();
                $listaUsuario = $usuario->getUsuario();
                $efound = false;            
                foreach ($listaUsuario as $u) {
                    if ($email == $u['email']) {
                        $efound = true; 
                        $u = $u['_id'];
                        header('location:../mantenimiento.php?mjs=true&&ml='.$u);                   
                            
                        } else {           
                            header('location:../mantenimiento.php?mjs=notFound&&ml=0'); 
                        }
                    } 
                }
    } else {
        header('location:../mantenimiento.php');
    }



?>
