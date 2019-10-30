<?php if (isset($_GET["mjs"])) {
    $mjs = $_GET['mjs'];


    switch ($mjs) {

        case "vuser":
            ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debes ingresar un nombre de usuario </p>
        <?php
                break;
            case "vemail":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debes ingresar un email para registrarte </p>
        <?php
                break;
            case "vpass":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debes ingresar una contraseña </p>
        <?php
                break;
            case "vrepass":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debes ingresar la contraseña 2 veces </p>
        <?php
                break;
            case "exist":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> La cuenta ingresada ya existe, puedes <a href="../index.php" ">ingresar aqui</a></p> 
        <?php
                break;
            case "wrongpass":
                ?>
            <p class=" poppins semibold" style="color: #D54D4D;"> No se ingreso la misma contraseña</p> 
        <?php
                break;
                case "wrongmail":
                ?>
            <p class=" poppins semibold" style="color: #D54D4D;"> Debes ingresar un email valido</p> 
        <?php
                break;
        }
    } else {
        ?>
        <p>Crearse una cuenta nunca había sido tan fácil y rápido,
            ingresa los datos correspondientes y ¡comienza ya con
            tu proyecto!
        </p>
    <?php
    }
    ?>