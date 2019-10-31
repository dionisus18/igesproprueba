<?php

//  if (isset($_POST['emailLogin']) && isset($_POST['passLogin'])) {
// if (isset($_POST['password'])) {
//      include_once 'validaciones.php';

//      $email = $_POST['emailLogin'];
     $pass = $_POST['password'];
//      $pass = $_POST['passLogin'];

//      $campoVacio = camposVacios($email);
//      if ($campoVacio == true) {
//          header('location:../index.php?mjs=vuser');
//      } else {
//          $campoVacio = camposVacios($pass);
//          if ($campoVacio == true) {
//              header('location:../index.php?mjs=vpass');
//         } else {

            include_once '../model/usuarios.php';
            session_start();
            $usuario = new Usuarios();
            // $pass = md5($_POST['passLogin']);

            $listaUsuario = $usuario->getUsuario();
            $efound = false;
            foreach ($listaUsuario as $u) {
                // if ($email == $u['email']) {
                    $efound = true;
                    if ($pass == $u['pass']) {
                        $_SESSION['idUsuario'] = $u['_id'];
                        echo "ok";                        
                        // header('location:../view/dashboard.php');
                    // } else {
                        // header('location:../index.php?mjs=pass'); //aqui va si la password es erronea
                    // }
                }else{
                    echo false;
                } 
            }

            // echo print_r($listaUsuario);

 //            if($efound == false){
 //                 header('location:../index.php?mjs=notFound'); //aqui va si la cuenta no existe
 //             }

 //         }
 //     }
 // } else {
 //     header('location:../index.php');
 // }
?>


