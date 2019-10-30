<!DOCTYPE html>
<html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../controller/expirarSession.php'
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
    <link rel="stylesheet" href="https://use.typekit.net/exz7ifs.css">
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

    <!-- seccion 1 -->
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
    <!-- fin de la seccion 1 -->

    <nav class="proyNav">
        <div class="sidenavCont">
            <a href="proyecto.php">
                <img src="../img/icono-home.png" class="iside">
                <p class="poppins">Resumen proyecto</p>
            </a>
            <br><br><br>
            <a href="nuevaTarea.php">
                <img src="../img/icono-plus.png" class="iside">
                <p class="poppins">Nueva Tarea</p>
            </a>
            <br><br><br>
            <a href="estadoProyecto.php">
                <img src="../img/icono-chart.png" class="iside">
                <p class="poppins">Estado Proyecto</p>
            </a>
            <br><br><br>
            <a href="detalleIntegrantes.php">
                <img src="../img/icono-adress.png" class="iside">
                <p class="poppins">Detalles Integrantes</p>
            </a>
        </div>
    </nav>

    <!-- seccion 2 -->
    <section class="nProy NT">
        <div class="wbox left">
            <div class="boxc">
                <p class="poppins semibold">Crear una nueva tarea</p>

                <?php include '../controller/cargarAgregarTarea.php' ?>
            </div>
        </div>
    </section>

    <section class="NTsection">
        <img src="../img/kanbi.png" class="kanbi">
    </section>
</body>

</html>