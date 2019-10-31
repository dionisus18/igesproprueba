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
                <p id ="titulo" class="titulo">Cambiar contraseña</p>
                <p id ="mensajes">Para cambiar la contraseña debes ingresar el correo con el cuál te has resgistrado.</p>
                <br>
                <div id="registroContent">
                    <!-- formulario de restablecimiento de contraseña -->
                    <form id="formEmail">           
                        <label for="femail">Correo electronico:</label>                        
                        <input type="text" id="femail"  name="email">                        
                        <input type="submit" value="Cambiar Contraseña">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- fin de la seccion 1 -->
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js"></script> 
    <script src="controller/js/amazon-cognito-auth.min.js"></script>
    <script src="controller/js/amazon-cognito-identity.min.js"></script>   
    <script src="controller/js/config.js"></script>
    <script type="text/javascript">
        let registroContent = document.getElementById("registroContent");
        let titulo = document.getElementById("titulo");
        let formulario = document.getElementById("formEmail");
        let mensajes = document.getElementById("mensajes");
        let email = document.getElementById("femail");
        
        let poolData;

        let segundoForm = `<form id="formValidacion">
        <label for="fpass">Codigo de Validacion:</label>
        <input type="text" id="verificationCode" name="verificationCode"
        placeholder="Ingrese codigo aca">
        <label for="fpass">Contraseña:</label>
        <input type="password" id="fpass" name="fpass"
        placeholder="Escriba su contraseña aqui">
        <label for="frep">Repita la contraseña:</label>
        <input type="password" id="frep" name="frep"
        placeholder="Vuelva a escribir su contraseña aqui">
        <input type="submit" value="Confirmar">
        </form>`;

        poolData = {
            UserPoolId : _config.cognito.userPoolId, 
            ClientId : _config.cognito.clientId 
        };
        let userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);
        let userData = {};

        formulario.addEventListener("submit", function(evt) {
            evt.preventDefault();
            if (email && email.value && email.value.trim() != "") {
                userData = { 
                    Username : email.value.trim(),
                    Pool : userPool
                };
                if (userData.hasOwnProperty("Username") && userData.Username != "") {
                    console.table(userData);
                    cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);
                    cognitoUser.forgotPassword({
                        onSuccess: function (result) {
                            // console.log('call result: ' + result);
                            console.log("1")
                        },
                        onFailure: function(err) {
                            // alert(err);
                            console.log("2",err);
                            if (err.code == "UserNotFoundException") {
                                mensajes.textContent = "El correo ingresado no esta asociado a una cuenta";
                                addClass(mensajes, "poppins");
                                addClass(mensajes, "semibold");
                            }else if (err.code == "UnknownError") {
                                mensajes.textContent = "Error en el servidor";
                                addClass(mensajes, "poppins");
                                addClass(mensajes, "semibold");
                            }else if (err.code == "LimitExceededException") {
                                mensajes.textContent = "Excedidas las respuestas para el dia de hoy :/";
                                addClass(mensajes, "poppins");
                                addClass(mensajes, "semibold"); 

                            }
                        },
                        inputVerificationCode() {
                            console.log("3");
                            registroContent.innerHTML = segundoForm;
                            titulo.textContent = "Verificación";
                            mensajes.textContent = "Se ha enviado un codigo de Verificación al correo ingresado";
                            removeClass(mensajes, "poppins");
                            removeClass(mensajes, "semibold");
                            let segundoForm = document.getElementById("formValidacion");
                            formulario.addEventListener("submit", function(evt) {
                                let password = document.getElementById("fpass");
                                let passwordVal = document.getElementById("frep");
                                let verificationCode = document.getElementById("verificationCode");

                                if (verificationCode && verificationCode.value.trim() != "" && password && passwordVal && passwordVal.value.trim() != "" && password.value.trim() != "") {
                                    if (passwordVal.value.trim() == password.value.trim()) {

                                    }else{
                                        mensajes.textContent = "Las contraseñas ingresadas no coinciden";
                                        addClass(mensajes, "poppins");
                                        addClass(mensajes, "semibold");
                                    }
                                }else{
                                    mensajes.textContent = "No ingrese campos vacios";
                                    addClass(mensajes, "poppins");
                                    addClass(mensajes, "semibold");
                                }
                                cognitoUser.confirmPassword(verificationCode, newPassword, this);
                            });
                            // let verificationCode = prompt('Please input verification code ' ,'');
                            // let newPassword = prompt('Enter new password ' ,'');
                            // cognitoUser.confirmPassword(verificationCode, newPassword, this);
                        }
                    });
                }
                // if (passwordVal.value === password.value) {
                //     registrar(email.value, password.value);
                // }else{
                //     alert("Las contraseñas no coinciden");
                // }
            }else{
                mensajes.textContent = "Debes ingresar el email antes de cambiar una contraseña";
                addClass(mensajes, "poppins");
                addClass(mensajes, "semibold");
            }
        });

        // cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);
        // cognitoUser.forgotPassword({
        //     onSuccess: function (result) {
        //         console.log('call result: ' + result);
        //     },
        //     onFailure: function(err) {
        //         alert(err);
        //     },
        //     inputVerificationCode() {
        //         let verificationCode = prompt('Please input verification code ' ,'');
        //         let newPassword = prompt('Enter new password ' ,'');
        //         cognitoUser.confirmPassword(verificationCode, newPassword, this);
        //     }
        // });

        function addClass(el, className) {
            if (el.classList)
              el.classList.add(className);
          else
              el.className += ' ' + className;
      }
      function removeClass(el, className) {
        if (el.classList)
          el.classList.remove(className);
      else
        el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
}

function toggleClass(el, className) {
    if (el.classList) {
      el.classList.toggle(className);
  } else {
      var classes = el.className.split(' ');
      var existingIndex = classes.indexOf(className);

      if (existingIndex >= 0)
        classes.splice(existingIndex, 1);
    else
        classes.push(className);

    el.className = classes.join(' ');
}


}
</script>
</body>
</html>