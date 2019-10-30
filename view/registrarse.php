<!DOCTYPE html>
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
</head>
<body class="reg">

    <!-- Este header es el mismo en todas las paginas de GESPRO -->
    <header>
        <nav>
            <img src="../img/Nav.png" class="navImg">
            <ul>
                <li><a href="index.php">GESPRO</a></li>
            </ul>
        </nav>
    </header>
    <!-- Fin del header -->

    <!-- seccion 1 -->
    <section class="section a">
        <div class="back">
            <a href="../index.php">
                <img src="../img/icono-back.png" class="iback">
                <p> Volver a la pagina principal </p>
            </a>

        </div>

        <div class="wbox">
            <img src="../img/Isotipo.png" class="isotipo">
            <div class="registro">
                <p class="titulo">Crear una cuenta</p>
                <?php include '../controller/mensajes/crearCuenta.php'; ?>
                <br>
                <!-- formulario de registro -->
                <form id="formLogin" action="../controller/agregarUsuario.php" method="POST" enctype="multipart/form-data" >
                    <label for="fnombre">Nombre:</label>
                    <input type="text" id="fnombre" name="nombre"
                    placeholder="Escriba su nombre aqui">
                    <label for="femail">Correo electronico:</label>
                    <input type="text" id="femail" name="email"
                    placeholder="Escriba su correo electronico aqui">
                    <label for="fpass">Contraseña:</label>
                    <input type="password" id="fpass" name="pass"
                    placeholder="Escriba su contraseña aqui">
                    <label for="frep">Repita la contraseña:</label>
                    <input type="password" id="frep" name="repass"
                    placeholder="Vuelva a escribir su contraseña aqui">
                    <input type="submit" value="¡Crear cuenta y comenzar con mi proyecto!">
                </form>
                <!-- fin del formulario de registro -->
            </div>
        </div>
    </section>
    <!-- fin de la seccion 1 -->
</body>
<script src="https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js"></script> 
<script src="../controller/js/amazon-cognito-auth.min.js"></script>
<script src="../controller/js/amazon-cognito-identity.min.js"></script>   
<script src="../controller/js/config.js"></script>
<script type="text/javascript">

    let formulario = document.getElementById("formLogin");
    let email = document.getElementById("femail");
    let password = document.getElementById("fpass");
    let nombre = document.getElementById("fnombre");
    let passwordVal = document.getElementById("frep");
    let nombreUsuario = email;
    let poolData;

    formulario.addEventListener("submit", function(evt) {
        evt.preventDefault();
        console.log(email.value,password.value)
        if (email && password && passwordVal && email.value && password.value && nombre && nombre.value) {
            if (passwordVal.value === password.value) {
                registrar(email.value, password.value);
            }else{
                alert("Las contraseñas no coinciden");
            }
        }
    });
    // prueba();
    function registrar(email, password){
        poolData = {
            UserPoolId : _config.cognito.userPoolId, 
            ClientId : _config.cognito.clientId 
        };      
        var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);

        var attributeList = [];

        var dataEmail = {
           Name : 'email',
           Value : email,
       };

       var dataPersonalName = {
           Name : 'name',
           Value : email,
       };

       var atributoEmail = new AmazonCognitoIdentity.CognitoUserAttribute(dataEmail);
       var atributoNombreUsuario = new AmazonCognitoIdentity.CognitoUserAttribute(dataPersonalName);

       attributeList.push(atributoEmail);
       attributeList.push(atributoNombreUsuario);



     // let guardadoMongoDB = new Promise((resolve, reject) => {
        userPool.signUp(email, password, attributeList, null, function(err, result){
           if (err) {
            console.error(err.message || JSON.stringify(err));
            if (err.message == "An account with the given email already exists.") {
                alert("Ya existe registrada una cuenta con ese correo")
            }
            reject(err.message);
            return;
        }
        cognitoUser = result.user;
        console.log(result);
        var formData = new FormData();
        formData.append("password",password);
        formData.append("id",result.userSub);
        formData.append("email",email);
        formData.append("nombre",nombre.value);
        var request = new XMLHttpRequest();
        request.open('POST', '../controller/agregarUsuario.php', true);
        request.send(formData);
        request.onreadystatechange = function() { 
            if (request.readyState == 4){
                    // console.log("holita mundito 2");
                    if (request.status == 200){
                        // console.log("holita mundito 3");
                        var json_data = request.responseText; 
                        console.log(json_data, request);
                        if (json_data.trim() == "ok") {
                            console.log("llegada");
                            window.location.replace("../index.php?mjs=ucreated");
                        }
                    }
                }
            }

        // resolve(data);
    });
    // });

       // guardadoMongoDB.then((data) => {
        // console.log(data);
        
    // });

}

</script>
</html>