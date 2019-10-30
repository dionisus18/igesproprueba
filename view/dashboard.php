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
        <div class="proyectos">
            <p class="poppins extra"> Mis proyectos en desarrollo</p>
            <!-- Tabla de proyectos -->
            <table class="poppins listProy">
                <!-- lista de nombre de columnas -->
                <tr class="Principal">
                    <th>Nombre</th>
                    <th>Tareas</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
                <!-- Fom de lista de nombres -->

                <!-- Corresponde a una fila = un proyecto-->
                <?php include "../controller/cargarProyectosDesarrollo.php" ?>
                <!-- Fin nueva fila -->
            </table>
            <!-- Fin de la tabla de proyectos -->

            <!-- Tabla de proyectos terminados, los comentarios son los mismos que los anteriores -->
            <div class="space2"></div>
            <p class="poppins extra proyectosTerminados"> Mis proyectos en
                Terminados</p>
            <table class="poppins listProy">
                <tr class="Principal">
                    <th>Nombre</th>
                    <th>Tareas</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
                <!-- Proyectos de prueba para visualizacion de la interfaz -->
                <?php include "../controller/cargarProyectosTerminados.php" ?>
                <!-- Fin de los proyectos de prueba para la visualizacion -->
            </table>
        </div>
        <div class="wbox">
            <div class="cont">
                <p class="poppins bold">¡Bienvenidos al ambiente de pruebas de GESPRO!</p>
                <p class="poppins">Primero que nada muchas gracias por participar en este ambiente de pruebas, el equipo de
                    GESPRO considerara valiosamente cada aporte y comentario que nos entreguen sobre esta aplicacion web. </p>
                <br>
                <p class="poppins">GESPRO aun se encuentra en su etapa de implementacion, por lo que este hosting no sera permanente,
                    aun asi, migraremos toda la base de datos de las pruebas que se realicen en esta version cuando implementemos nuestros servicios
                    en AWS, por lo que te animamos a que trabajes con el programa como si fuera la version final, ya que, ¡pretendemos que no notes cuando nos migremos al
                    servicio esperado!, Sin mas que compartir esperamos que tengan una buena experiencia utilizando GESPRO, y logren sacar el maximo provecho de su tiempo
                    obteniendo el valor que esperan de este servicio.
                </p>
                <br>
                <p class="poppins">Te invitamos a leer las instrucciones de uso basicas y dejar cualquier comentario en nuestro formulario:
                </p><a href="https://forms.gle/Xi7xRPQPfeCqARYm7" target="_blank">Ir al formulario</a>
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