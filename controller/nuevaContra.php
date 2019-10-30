<?php 

if(isset($_POST['email']) && isset($_POST['fpass']) &&  isset($_POST['frep'])){
    include_once 'validaciones.php';

    $pass = $_POST['fpass'];
    $repass = $_POST['frep']; 
    $email = $_POST['email'];


    $campoVacio = camposVacios($pass);
    if ($campoVacio == true) {
        header('location:../mantenimiento.php?mjs=vpass&&ml='.$email);
    } else {
        $campoVacio = camposVacios($repass);
    if ($campoVacio == true) {
        header('location:../mantenimiento.php?mjs=vrepass&&ml='.$email);
    }else{
        include_once '../model/usuarios.php';
        $usuario = new Usuarios();
        $listaUsuario = $usuario->getUsuario();
        foreach ($listaUsuario as $u) {
            if ($email == $u['_id']) {                
                $pass = md5($_POST['fpass']);
                $nuevosDatos = $usuario->cambiarPass($email, $pass);       
                header('location:../mantenimiento.php?mjs=changed&&ml='.$email);                 
                    
                } else {           
                    echo print_r('nada especial'); 
                }
            } 
        
    }
    }
}
?>
