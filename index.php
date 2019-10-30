<!DOCTYPE html>
<?php
require_once "config.php";
if (isset($_SESSION['idUsuario'])) {
    header('Location: view/dashboard.php');
    exit();
}
$loginURL = $gClient->createAuthUrl();

$redirectURL = "http://localhost/Gespro/fb-callback.php";
$permissions = ['email'];
$loginURL2 = $helper->getLoginUrl($redirectURL, $permissions);
?>
<?php

unset($_SESSION['idUsuario']);
?>
<html class="indexHTML">

<head>
    <title>
        GESPRO, Gestion de proyectos online
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/propiedades.css">
    <link rel="stylesheet" type="text/css" href="css/detalles.css">
    <link rel="stylesheet" type="text/css" href="css/last.css">
    <link rel="stylesheet" href="https://use.typekit.net/exz7ifs.css">
</head>

<body>
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

    <!-- seccion 1 informacion + login -->
    <section class="section a">

        <div class="textoPrincipal">
            <img src="img/Logotypo.png" class="logo">
            <p class="titulo">Herramienta de gestion al alcance de su mano</p>
            <p class="descripcion">
                Gespro es una herramienta de gestión y administración de
                proyectos online,
                caracterizada por su simpleza y rapidez. Enfocada a
                estudiantes y grupos independientes de trabajo,
                Gespro ofrece entregar la información rápida y concisa,
                caracterizando, estado del proyecto,
                indicadores de rendimiento del equipo y rendimiento propio
                igual.
                <br><br>
                Para todo aquel que busca la simpleza, Gespro la entrega de
                forma inmediata y legible
            </p>
        </div>
        <!-- caja blanca + login -->
        <div class="wbox">
            <img src="img/Isotipo.png" class="isotipo">
            <div class="login">
                <?php include 'controller/mensajes/ingreso.php' ?><br>
                <!-- Formulario de login -->
                <form id="formLogin"action="controller/ingresoUsuario.php" method="POST" enctype="multipart/form-data">
                    <label for="femail">Email:</label>
                    <input type="text" id="femail" name="emailLogin" placeholder="Escriba su email aqui">
                    <label for="fpass">Contraseña:</label>
                    <input type="password" id="fpass" name="passLogin" placeholder="Escriba su contraseña aqui">
                    <input type="submit" value="Ingresar">                    
                </form>                
                <!-- Fin del formulario de login -->
                <p>¿No tienes cuenta? <a href="view/registrarse.php">¡Crear una
                aquí!</a> completamente gratis</p>
                <p> o </p>
                <p>Tambien puedes ingresar con alguna de tus redes sociales:</p>
                
                <!-- Redes sociales -->
                <a onclick="" class="facebook">
                    <p><img src="img/icono-facebook.png" class="iface">
                    Utiliza tu cuenta de Facebook </p>
                </a>
                <a onclick="" class="google">
                    <p><img src="img/icono-google.png" class="igoogle">
                    Utiliza tu cuenta de Google </p>
                </a>
                <!-- Fin de las redes sociales -->
                <p class="ppass"><a href="mantenimiento.php">¿Has
                olvidado tu contraseña?</a></p>
            </div>
        </div>
        <!-- fin de la caja blanca + login -->

    </section>


    
    

    <!-- fin de la seccion 1 -->
    <!-- seccion 2, informacion -->
    <!--
        <section class="section b">
      
            <div class="wbox">
                <div class="textob">
                    <p class="titulo">¡Gestión y administracion en el mismo
                        lugar!</p>
                    <br>
                    <p class="descripcion">
                        Trabajar con una herramienta de gestión y administración
                        de proyectos nunca resulto tan fácil y rápido,
                        Gespro te permite visualizar rápidamente todas las
                        tareas de tu proyecto, y determinar el estado de tu
                        rendimiento personal y del proyecto
                        <br><br>
                        Comprueba tu desempeño a través de nuestros 3 pilares
                        fundamentales:
                        <br>
                        Cumplimiento
                        <br>
                        Organización
                        <br>
                        Motivación
                        <br>
                        <br>
                        Además de monitorear un estado general del proyecto
                        basado en:
                        <br>
                        Tareas realizadas vs tareas planificadas
                        <br>
                        Horas realizadas vs horas planificadas
                        <br>
                        Resumen de atrasos
                        <br>
                        Porcentaje de avance del proyecto
                        <br>
                        <br>
                        Finalmente para cerrar con broche de oro, Gespro le
                        permitirá ver un resumen del desempeño
                        de cada uno de los integrantes de su proyecto,
                        resaltando todo lo mencionado anteriormente
                    </p>
                </div>
            </div>
        
            
            
        </section>
        <section class="section c">
            <div class="wbox">
                <div class="contacto">
                    <p>Si tienes dudas y quieres mas informacion, no esperes mas
                        y contactanos, nuestros asistentes estaran trabajando
                        para contactarte</p>
                    <form action="#">
                        <label for="cemail">Email:</label>
                        <input type="text" id="cemail" name="email"
                            placeholder="Escriba su email aqui">
                        <label for="cmensaje">Mensaje:</label>
                        <textarea placeholder="Escriba su mensaje aqui"
                            class="ftexta"></textarea>
                        <input type="submit" value="Enviar mi consulta o solicitud de informacion">
                    </form>
                </div>
            </div>
            <img src="img/kanbi.png" class="kanbi">
        </section>

        <footer>

        </footer>
    -->


</body>

</html>
<script src="https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js"></script> 
<script src="controller/js/amazon-cognito-auth.min.js"></script>
<script src="controller/js/amazon-cognito-identity.min.js"></script>   
<script src="controller/js/config.js"></script>
<script type="text/javascript">
    let formulario = document.getElementById("formLogin");
    let email = document.getElementById("femail");
    let password = document.getElementById("fpass");

    formulario.addEventListener("submit", function(evt) {
        evt.preventDefault();
        console.log(email.value,password.value);
        if (email && password && email.value && password.value) {
            login(email.value, password.value);
        }

    });

    function login(email, password) {

        var authenticationData = {
            Username : email,
            Password : password,
        };

        var authenticationDetails = new AmazonCognitoIdentity.AuthenticationDetails(authenticationData);

        var poolData = {
        UserPoolId : _config.cognito.userPoolId, // Your user pool id here
        ClientId : _config.cognito.clientId, // Your client id here
    };
    
    var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);
    
    var userData = {
        Username : email,
        Pool : userPool,
    };
    
    var cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);
    
    cognitoUser.authenticateUser(authenticationDetails, {
        onSuccess: function (result) {
            var accessToken = result.getAccessToken().getJwtToken();
            console.log(cognitoUser.username);
            var formData = new FormData();
            formData.append("password",cognitoUser.username);
            var request = new XMLHttpRequest();
            request.open('POST', 'controller/ingresoUsuario.php', true);
            request.send(formData);
            request.onreadystatechange = function() { 
                if (request.readyState == 4){

                    if (request.status == 200){

                        var json_data = request.responseText; 
                        console.log(json_data, request);
                        if (json_data.trim() == "ok") {
                            console.log("llegada");
                            window.location.replace("view/dashboard.php");
                        }
                    }
                }
            }

        },
        onFailure: function(err) {
            console.error(err.message || JSON.stringify(err));
            if (err.message == "Unkown error") {
                alert("No ha confirmado su cuenta")
            }else{
                alert(err.message || JSON.stringify(err));
            }
        },
    });
}   



</script>