<?php if (isset($_GET["mjs"])) {
    $mjs = $_GET['mjs'];


    switch ($mjs) {

        case "pass":
            ?>
            <p class="poppins semibold" style="color: #D54D4D;"> La contraseña ingresada es incorrecta </p>
        <?php
                break;

         case "notConfirmed":
            ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debe Confirmar su cuenta antes de ingresar. </p>
        <?php
                break;

            case "notFound":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> La cuenta ingresada no existe </p>
        <?php
                break;
            case "vuser":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> No ingresaste una cuenta </p>
        <?php
                break;
            case "vpass":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> No ingresaste una contraseña </p>
        <?php
                break;
            case "ucreated":
                ?>
            <p class="poppins semibold" style="color: #6C8ECE;"> ¡Cuenta creada! No olvides confirmar tu correo </p>
        <?php
                break;
        }
    } else {
        ?>
        <p class="poppins semibold"> ¡Comienza a administrar tus proyectos! </p>
    <?php
    }
    ?>