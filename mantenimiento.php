<?php 
require 'vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        GESPRO, Gestion de proyectos online
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/detalles.css">
    <link rel="stylesheet" href="https://use.typekit.net/exz7ifs.css">        
</head>
<body class="reg">

    <!-- Este header es el mismo en todas las paginas de GESPRO -->
    <header>
        <nav>
            <img src="img/Nav.png" class="navImg">
            <ul>
                <li><a href="index.php">GESPRO</a></li>
            </ul>
        </nav>
    </header>
    <!-- Fin del header -->

    <!-- seccion 1 -->
    <section class="section a">
        <div class="back">
            <a href="index.php">
                <img src="img/icono-back.png" class="iback">
                <p> Volver a la pagina principal </p>
            </a>

        </div>

        <div class="wbox">
            <img src="img/Isotipo.png" class="isotipo">

            <div class="registro">
                <p class="titulo">Cambiar contraseña</p>

                <br>
                <?php include 'controller/mensajes/cambioContraseña.php'; ?>  
                <?php 
                $inputData;   
                $email;  
                if ($inputData == 0){ ?>           
                    <!-- formulario de restablecimiento de contraseña -->
                    <form action="controller/nuevaContraseña.php" method="POST" enctype="multipart/form-data" >                      
                        <label for="femail">Correo electronico:</label>                        
                        <input type="text" id="femail" name="email">                        
                        <input type="submit" value="Cambiar Contraseña">
                        
                    </form>
                    <!-- fin del formulario de restablecimiento de contraseña -->
                    <?php
                }else 
                if($inputData == 1){ ?>                                
                    <form action="controller/nuevaContra.php" method="POST" enctype="multipart/form-data" >
                        <label for="fpass">Contraseña:</label>
                        <input type="hidden" id="email" name="email" value="<?php echo $email; ?>">
                        <input type="password" id="fpass" name="fpass"
                        placeholder="Escriba su contraseña aqui">
                        <label for="frep">Repita la contraseña:</label>
                        <input type="password" id="frep" name="frep"
                        placeholder="Vuelva a escribir su contraseña aqui">
                        <input type="submit" value="Cambiar contraseña">
                        
                    </form>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- fin de la seccion 1 -->
</body>
</html>