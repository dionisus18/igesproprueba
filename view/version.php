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

    <section class="sdash">
    <div class="proyectos poppins semibold">
            <p class="poppins bold">Actualizacion de GESPRO v1.1 </p>
            <p class="poppins cod">09/10/2019</p><br>
            <p class="poppins semibold colorVerde">Nuevo</p><br>
            <p class="poppins">· Se agregaron mensajes de errores al iniciar session y crearse una cuenta: </p>
            <p class="poppins cod">Este sera un arreglo temporal, el equipo de gespro busca entregar una mejor forma de visualizacion de errores, sin embargo nos importa que sepan si estan ingresando bien sus datos en el sistema inicial (registro e inciar session) para que no ocurran malos entendidos, ademas se recuerda, que las instruccioes de uso de la aplicacion web se encuentran en el formulario de inicio </p><br>
            <p class="poppins">Muchas gracias por su comprension y apoyo, seguiremos trabajando para mejorar la experiencia de trabajar con Gespro </p>
            <br><br>
            <hr>



        <div class="proyectos poppins semibold">
            <p class="poppins bold">Actualizacion de GESPRO v1.0 </p>
            <p class="poppins cod">29/09/2019</p><br>
            <p class="poppins semibold colorVerde">Nuevo</p><br>
            <p class="poppins">· Pestaña de administracion de proyectos: </p>
            <p class="poppins cod">Esta nueva ventana te permitira ver multiples proyectos a la vez, lo unico que debes hacer es crear un codigo de proyecto e informacion a los lideres de distintos de este para que registren sus proyectos para poder visualizarlos en esta nueva pestaña</p><br>
            <p class="poppins">· Informacion de proyecto: </p>
            <p class="poppins cod">Se agrego un boton de informacion de proyecto dentro de tu proyecto, al presionarlo podras encontrar el nombre del proyecto, codigo de proyecto y codigo grupal de proyecto, podra modificarse el nombre y codigo grupal, ademas podras eliminar el proyecto, pero solo si no tiene ninguna tarea agregada</p><br>
            <p class="poppins">· Filtro de tareas: </p>
            <p class="poppins cod">Se agrego un filtro para las tareas, puedes buscar por nombre, responsable o estado de la tarea</p><br>
            <p class="poppins semibold colorAzul">Arreglos</p><br>
            <p class="poppins">· Se corrigio un error que hacia que el compromiso de estado personal se visualizaba de forma erronea</p><br>
            <p class="poppins">· Se corrigio un error en donde la organizacion no se estaba calculando correctamente</p><br>
            <p class="poppins">· Se asigno el permiso de lider de proyecto a todos los proyectos, podran ver quien es el lider a travez del boton de informacion de proyecto, este ademas tendra permisos sobre todas las tareas del proyecto</p><br>
            <p class="poppins">· Se elimino de la interfaz "Proyecto:" y "Detalle tarea:" en sus respectivas ventanas</p><br>
            <p class="poppins">· Se actualizo la zona horaria interna del servidor a la chilena (antes se encontraba en europa)</p><br>
            <p class="poppins">· Solo se podra aprobar una tarea solo 1 vez desde ahora</p><br>
            <p class="poppins">· Se desabilitaron los campos que no pueden ser editados</p><br>
            <p class="poppins">· Se optimiso la visualizacion de la pagina web para pantallas de 1440, 1366 y 1024</p><br>
            <p class="poppins semibold">Problemas conocidos</p><br>
            <p class="poppins">· Se pueden crear cuentas con emails no existentes, sin embargo el realizar esto provoca que como GESPRO no podamos brindar la ayuda correspondiente en el futuro para la recuperacion de contraseña</p><br>
            <p class="poppins">· El inicio de session con redes sociales no estan disponibles</p><br>
            <p class="poppins">· La recuperacion de contraseña no es posible actualmente</p><br>
            <p class="poppins">· Aun no se muestran mensajes de errores</p><br>
            <br><br>
            <hr>




            <p class="poppins bold">Correccion de errores GESPRO v0.2.1 </p>
            <p class="poppins cod">21/09/2019</p><br>
            <p class="poppins semibold colorVerde">Nuevo</p><br>
            <p class="poppins">· Si te encuentras inactivo por mas de 40m se cerrara automaticamente la session</p><br>
            <p class="poppins">· Se redondean los valores porcentuales de motivacion, organizacion y compromiso encontrados en el resumen personal de usuario</p><br>
            <p class="poppins semibold colorAzul">Arreglos</p><br>
            <p class="poppins">· Las tareas atrasadas ya se actualizan correctamente segun la fecha</p><br>
            <p class="poppins">· Ya se pueden agregar tareas con 0 horas asignadas para representar las tareas hito</p><br>
            <p class="poppins">· Se corrijio un error en donde bajo ciertas cirscunstancias podian agregar horas de trabajo real negativas en la modificacion de tareas</p><br>
            <p class="poppins">· Se corrijio un error el cual permitia a un usuario que no habia ingresado session acceder a paginas especificas</p><br>
            <p class="poppins">· Se establecieron limites de largo al largo de la tabla para no romperlas cuando los nombres de las tareas sean muy largos</p><br>
            <p class="poppins">· Se cambio la forma en que se modificaban los detalles de las tareas </p>
            <p class="poppins cod">Este cambio se realizo debido a que no se podia modificar ninguna informacion de una tarea atrasada sin antes cambiarle la fecha a una actual</p><br>
            <p class="poppins">El equipo de GESPRO tiene como prioridad solucionar los problemas que puedan afectar el funcionamiento correcto de nuestra plataforma, por lo que si encuentras un error no olvides reportarlo a travez del formulario que encontraras en la pagina principal (donde estan todos tus proyectos)</p><br>
            <br><br>
            <hr>


            <p class="poppins bold">Actualizacion de version GESPRO v0.2 </p>
            <p class="poppins cod">19/09/2019</p><br>
            <p class="poppins semibold colorVerde">Nuevo</p><br>
            <p class="poppins">· Ahora si un usuario no posee ninguna tarea asignada, no podra verse en el detalle de integrantes: </p>
            <p class="poppins cod">Esto facilitara que el docente pueda ingresar a los proyectos y este no sea visto en el detalle de integrantes</p>
            <br>
            <p class="poppins">· Se agrego la pestaña de Fecha de aprobacion en el detalle de tareas</p>
            <br>
            <p class="poppins">· Se implemento un sistema de permiso en donde la unica persona que puede realizar cambios en una tarea (modificar, eliminar o aprobarla) es aquella que la creo, sin embargo cualquier integrante del proyecto puede utilizar las funciones de comentarios y subir, descargar o eliminar archivos</p>
            <br>
            <p class="poppins semibold colorAzul">Arreglos</p><br>
            <p class="poppins">· Ya se encuentra funcionando el sistema de archivos, por lo que puedes comenzar a subir, descargar o eliminar los archivos de tus tareas</p>
            <br>
            <p class="poppins">· Solo se puede subir 1 archivo al mismo tiempo, para subir otro deberas eliminar el que tienes actualmente</p>
            <br>
            <p class="poppins">· Se arreglo un error en donde se podia crear una cuenta con un email ya existente </p>
            <p class="poppins cod">[Problema encontrado por Jhonatan Ramos, muchas gracias por tu apoyo al proyecto]</p>
            <br>
            <p class="poppins semibold">Problemas conocidos</p><br>
            <p class="poppins">· Se pueden crear cuentas con emails no existentes, sin embargo el realizar esto provoca que como GESPRO no podamos brindar la ayuda correspondiente en el futuro para la recuperacion de contraseña</p>
            <br>
            <p class="poppins">· El inicio de session con redes sociales no estan disponibles</p>
            <br>
            <p class="poppins">· La recuperacion de contraseña no es posible actualmente</p>
            <br>
            <p class="poppins">Los problemas anteriores van a ser solucionados cuando implementemos el servicio de aws cognito</p>
            <br>


            <br><br>
            <hr>
            <p class="poppins bold">¡Lanzamiento del ambiente de pruebas de GESPRO! v0.1 </p>
            <p class="poppins cod">16/09/2019</p><br>
            <p class="poppins">· Se lanza Gespro, para mas informacion visita la pestaña de todos los proyectos en el recuadro blanco</p>
        </div>
    </section>
</body>

</html>