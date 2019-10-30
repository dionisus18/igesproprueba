<?php 

if (isset($_GET["mjs"])&& isset($_GET["ml"])) {
    $mjs = $_GET['mjs'];
    $ml = $_GET['ml'];
    $inputData= 0;

    switch ($mjs) {
     
            case "vemail":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debes ingresar el email antes de cambiar una contraseña </p>
        <?php
                break;
            case "vpass":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debes ingresar una contraseña </p>
        <?php
                break;
            case "true":
           $inputData = 1;
           $email = $ml;
                ?>  
        <?php
                break;
            case "changed":          
                ?>                
            <p class="poppins semibold" style="color: #D54D4D;"> Contraseña cambiada con exito </p>
        <?php
                break;
            case "notFound":   
            $inputData = 0;       
                ?>                
            <p class="poppins semibold" style="color: #D54D4D;"> El correo ingresado no esta asociado a una cuenta </p>
            
            
        <?php
                break;
            case "vrepass":
                ?>
            <p class="poppins semibold" style="color: #D54D4D;"> Debes ingresar la contraseña 2 veces </p>

        <?php
                break;
            case "wrongpass":
                ?>
            <p class=" poppins semibold" style="color: #D54D4D;"> No se ingreso la misma contraseña</p> 
        <?php
                break;
                case "wrongmail":
                ?>
            <p class=" poppins semibold" style="color: #D54D4D;"> El correo ingresado no existe</p> 
        <?php
                break;
        }
    } else {
        
        if(!$inputData = 0){
            ?>
        <p>Para cambiar la contraseña debes ingresar el correo con el cuál te has resgistrado.</p>
    <?php
    }
}
    ?>