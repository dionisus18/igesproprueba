<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../controller/actualizar.php';
?>
<!DOCTYPE html>
<?php
unset($_SESSION['idTarea']);
?>
<?php require_once '../controller/expirarSession.php' ?>
<html>

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
    <link rel="stylesheet" type="text/css" href="../css/last.css">
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
    <!-- fin de Side Nav -->

    <!-- seccion 1 -->
    <section class="sdash">

        <div class="proyectos" style="margin-bottom: 50px;">
            <p class="poppins extra">
                <?php include '../controller/informacionProyecto.php' ?>
                <br>

                <button id="modal-btn" class="button">Informacion de proyecto</button>

                <div class="filtroT">
                    <input type="text" id="filtroTP" onkeyup="filtro()" placeholder="Buscar tareas...">
                </div>

                <p class="poppins semibold">Tareas Proyecto</p>
            </p>



            <table class="poppins listTareas" id="tablaTP">
                <tr class="Principal">
                    <th>Nombre tarea</th>
                    <th>Responsable</th>
                    <th>Estado tarea</th>
                    <th></th>
                </tr>

                <?php include "../controller/cargarTareas.php" ?>

            </table>

            <div class="space2"></div>
            <div class="filtroT">
                <input type="text" id="filtroTE" onkeyup="filtro2()" placeholder="Buscar tareas...">
            </div>
            <p class="poppins semibold">Tareas Extras</p>
            <table class="poppins listTareas" id="tablaTE">
                <tr class="Principal">
                    <th>Nombre tarea</th>
                    <th>Responsable</th>
                    <th>Estado tarea</th>
                    <th></th>
                </tr>
                <?php include '../controller/cargarTareasExtra.php' ?>
            </table>
        </div>

    </section>

    <section class="tareasSection">
        <?php include '../controller/estadoPersonal.php' ?>

    </section>


    <?php include '../controller/cargarModal.php' ?>

    <script>
        // Get DOM Elements
        const modal = document.querySelector('#my-modal');
        const modalBtn = document.querySelector('#modal-btn');
        const closeBtn = document.querySelector('.close');

        // Events
        modalBtn.addEventListener('click', openModal);
        closeBtn.addEventListener('click', closeModal);
        window.addEventListener('click', outsideClick);

        // Open
        function openModal() {
            modal.style.display = 'block';
        }

        // Close
        function closeModal() {
            modal.style.display = 'none';
        }

        // Close If Outside Click
        function outsideClick(e) {
            if (e.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {


                window.location = $(this).data("href");

            });
        });
    </script>
    <script>
        function filtro() {

            var input, filter, table, tr, i, fc, fcol, sc, scol, tc, tcol;
            input = document.getElementById("filtroTP");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaTP");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                fc = tr[i].getElementsByTagName("td")[0];
                sc = tr[i].getElementsByTagName("td")[1];
                tc = tr[i].getElementsByTagName("td")[2];
                if (fc || sc || tc) {
                    fcol = fc.textContent || fc.innerText;
                    scol = sc.textContent || sc.innerText;
                    tcol = tc.textContent || tc.innerText;
                    if (fcol.toUpperCase().indexOf(filter) > -1 || scol.toUpperCase().indexOf(filter) > -1 || tcol.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }


        }
    </script>
    <script>
        function filtro2() {

            var input, filter, table, tr, i, fc, fcol, sc, scol, tc, tcol;
            input = document.getElementById("filtroTE");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaTE");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                fc = tr[i].getElementsByTagName("td")[0];
                sc = tr[i].getElementsByTagName("td")[1];
                tc = tr[i].getElementsByTagName("td")[2];
                if (fc || sc || tc) {
                    fcol = fc.textContent || fc.innerText;
                    scol = sc.textContent || sc.innerText;
                    tcol = tc.textContent || tc.innerText;
                    if (fcol.toUpperCase().indexOf(filter) > -1 || scol.toUpperCase().indexOf(filter) > -1 || tcol.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }


        }
    </script>
</body>

</html>