<!DOCTYPE html>
<html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../controller/expirarSession.php'
?>

<?php
unset($_SESSION['idProyecto']);
?>

<head>
    <title>
        GESPRO, Gestion de proyectos online
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/detalles.css">
    <link rel="stylesheet" type="text/css" href="../css/propiedades.css">
    <link rel="stylesheet" type="text/css" href="../css/last.css">
    <link rel="stylesheet" href="https://use.typekit.net/exz7ifs.css">
    <!-- Jquery para la tabla -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class="dashboard">

    <!-- Este header es el mismo en todas las paginas de GESPRO -->
    <header>
        <nav>
            <img src="../img/Nav.png" class="navImg">
            <ul>
                <li><a href="dashboard.php">GESPRO</a></li>
            </ul>
        </nav>
    </header>
    <!-- Fin del header -->

    <!-- side Nav -->
    <nav class="sidenav">
        <div class="sidenavCont">
            <a href="dashboard.php">
                <img src="../img/icono-home.png" class="iside">
                <p class="poppins">Todos los proyectos</p> 
            </a>
            <br><br><br>
            <a href="nuevoProyecto.php">
                <img src="../img/icono-folder.png" class="iside">
                <p class="poppins">Nuevo proyecto</p>
            </a>
            <br><br><br>
            <a href="perfil.php">
                <img src="../img/icono-perfil.png" class="iside">
                <p class="poppins">Perfil</p>
            </a>
            <br><br><br>
            <a href="grupoProyecto.php">
                <img src="../img/icono-grupo.png" class="iside iver">
                <p class="poppins">Administracion de proyectos</p>
            </a>
            <br><br><br>
            <a href="version.php">
                <img src="../img/icono-version.png" class="iside iver">
                <p class="poppins">Version</p>
            </a>
            <br><br><br>
            <a href="../logout.php">
                <img src="../img/icono-signout.png" class="iside">
                <p class="poppins">Cerrar Session</p>
            </a>
        </div>
    </nav>
    <!-- fin de Side Nav -->

    <!-- seccion 1 -->
    <section class="sdash">
        <?php include '../controller/cargarAdministracionProyecto.php' ?>

        <div class="wbox">
            <div class="cont">
                <p class="poppins bold">¿Posees muchos proyectos que administrar?</p><br>
                <p class="poppins">!Crear un codigo para grupos de proyectos¡ este te permitira llevar el control de todos ellos a la vez, sin embargo no podras realizar ningun cambio dentro de estos, esta herramienta es solo para la visualizacion de proyectos</p><br>
                <form action="../controller/agregarCodigoGrupal.php" class="poppins" method="POST" enctype="multipart/form-data">
                    <label for="ncg">Codigo Grupal:</label>
                    <input type="text" id="ncg" name="ncg" placeholder="Escriba el codigo grupal de proyectos a crear">
                    <input type="submit" value="Crear o unirse a codigo de proyecto" name="nuevoCodigoGrupal">
                </form>
                <br>
                <hr>
                <p class="poppins">Elimina antiguos codigos grupales que ya no estes ocupando:</p><br><br>
               <?php include '../controller/cargarGrupoProyectos.php' ?>
            </div>
        </div>
    </section>
    <!-- fin de la seccion 1 -->
    <!-- Jquery para el uso inteligente de tabla -->
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {

                window.location = $(this).data("href");
            });
        });
    </script>
</body>

</html>