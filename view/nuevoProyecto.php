<!DOCTYPE html>
<html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../controller/expirarSession.php';
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

    <!-- seccion 2 -->
    <section class="nProy">
        <div class="wbox left">
            <div class="boxc">
                <p class="poppins bold">Crear nuevo proyecto</p>

                <form action="../controller/agregarProyecto.php" class="poppins" method="POST" enctype="multipart/form-data">
                    <label for="fnombreP">(*) Nombre de proyecto:</label>
                    <input type="text" id="fnombreP" name="nombreProyecto" placeholder="Escriba el nombre de su proyecto">
                    <label for="fcodigo">(*)Codigo de proyecto:</label>
                    <input type="text" id="fcodigo" name="codProyecto" placeholder="Presione el boton de generar codigo">
                    <input type="button" value="Generar codigo de ingreso" disabled>
                    <br><br>
                    <p class="poppins">(*) Es necesario para el proyecto, generar un código de ingreso
                        y nombre de proyecto</p>
                    <br>
                    <p class="poppins">
                        Cuando creas el proyecto se generara sin tareas, y obtendrás automáticamente
                        el estado irrevocable de líder de proyecto, una vez dentro de este, podrás
                        asignar roles a tus participantes y crear sus tareas
                    </p>
                    <br>
                    <input type="submit" value="Crear proyecto">
                </form>

            </div>
        </div>

        <div class="wbox right">
            <div class="boxc">
                <p class="poppins bold">Ingresar a un proyecto</p>

                <form action="../controller/unirseProyecto.php" class="poppins" method="POST" enctype="multipart/form-data">
                    <label for="fcodigo">Codigo de proyecto:</label>
                    <input type="text" id="fcodigo" name="Ucod" placeholder="Ingrese el codigo de proyecto">
                    <input type="button" value="Buscar proyecto">
                    <br><br>
                    <label for="fname">Nombre de proyecto:</label>
                    <input type="text" id="fname" name="Uname" placeholder="Aqui aparecera el nombre del proyecto encontrado" disabled>
                    <br><br>
                    <p class="poppins">
                        Al encontrar el proyecto automáticamente te mostrara su nombre,
                        así podrás reconocerlo fácilmente</p>
                    <br>
                    <br>
                    <br><br>
                    <input type="submit" value="Unirse a proyecto">
                </form>
            </div>
        </div>



    </section>

</body>

</html>