<?php
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}else{
    $nombre = "";
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}else{
    $id = "";
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}else{
    $password = "";
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}else{
    $email = "";
}

// echo "{nombre:$nombre,email:$email,id:$id,password:$password}";

// if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['repass'])) {
if ($email != "" && $password != "" && $nombre != "" && $id != "") {
    // include_once 'validaciones.php';
    // $name = $_POST['nombre'];
    // $email = $_POST['email'];
    // $pass = $_POST['pass'];
    // $repass = $_POST['repass'];

    // $campoVacio = camposVacios($name);
    // if ($campoVacio == true) {
    //     header('location:../view/registrarse.php?mjs=vuser');
    // } else {
    //     $campoVacio = camposVacios($email);
    //     if ($campoVacio == true) {
    //         header('location:../view/registrarse.php?mjs=vemail');
    //     } else {
    //         $campoVacio = camposVacios($pass);
    //         if ($campoVacio == true) {
    //             header('location:../view/registrarse.php?mjs=vpass');
    //         } else {
    //             $campoVacio = camposVacios($repass);
    //             if ($campoVacio == true) {
    //                 header('location:../view/registrarse.php?mjs=vrepass');
    //             } else {


    require '../model/usuarios.php';

    $user = new Usuarios();
    session_start();

    // if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


        // if (!strcmp($pass, $repass)) {
    // include_once '../model/usuarios.php';
            // $pass = md5($_POST['pass']);
            // $usuario = $user->getUsuario();
            // $contUsuario = 0;
            // foreach ($usuario as $edb) {
            //     if ($edb['email'] == $email) {
            //         $contUsuario = 1;
            //     }
            // }
            // if ($contUsuario == 0) {
    try {
        $password = $id;
        $user->insertarUsuarios($nombre, $email, $password);
        echo "ok";
        // header('location:../index.php?mjs=ucreated');
    } catch (Exception $e) {
        // echo "{'error':$e}";
    }
    
            // } else {
                                // header('location:../view/registrarse.php?mjs=exist'); //el email ya existe
            // }
        // } else {
                            // header('location:../view/registrarse.php?mjs=wrongpass'); //contraseña ingresada no es la misma
        // }
    // } else {

                        // header('location:../view/registrarse.php?mjs=wrongmail'); //mail no valido
    // }
    //             }
    //         }
    //     }
    // }
} else {
    header('location:../view/registrarse.php');
};