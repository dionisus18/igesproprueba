<?php
include_once '../model/usuarios.php';
$usuario = new Usuarios();

$idUsuario = $_SESSION['idUsuario'];

$usuarioActual = $usuario->getOneUsuarioID($idUsuario);


include_once '../model/detalleUsuarios.php';
$detalles = new detalles();

$tareasTotales = $detalles->tareasTotalesUsuario($idUsuario);
$tareasRealizadas = $detalles->tareasRealizadasUsuario($idUsuario);
$tareasAtrasadas = $detalles->tareasAtrasadasUsuario($idUsuario);
$horasReales = $detalles->horasRealizadasUsuario($idUsuario);
$horasAtrasadas = $detalles->horasAtrasadasUsuario($idUsuario);

?>

<div class="wbox">
    <div class="Tcont">
        <p class="poppins bold">Mi resumen de estado</p>
        <p class="poppins">llevar un resumen de tus tareas te
            ayudara a
            saber el estado en el que te encuentras y
            que acciones debes tomar</p>
        <p class="poppins semibold cblue"> Tres pilares del proyecto</p>
        <table class="poppins listTareas">
            <tr class="filaNormal">
                <th class="Tcol1">Compromiso</th>
                <th class="Tcol completa">
                    <?php
                    $compromiso = $usuarioActual['compromiso'];

                    if ($compromiso == 0) {
                        echo "No aplica";
                    } else {
                        echo round($compromiso);
                        echo "%";
                    }


                    ?>
                </th>
            </tr>
            <tr class="filaNormal">
                <th class="Tcol1">Organizacion</th>
                <th class="Tcol revision">
                    <?php
                    $organizacion = $usuarioActual['organizacion'];
                    if ($organizacion == 0) {
                        echo "No aplica";
                    } else {
                        echo round($organizacion);
                        echo "%";
                    }
                    ?>
                </th>
            </tr>
            <tr class="filaNormal">
                <th class="Tcol1">Motivacion</th>
                <th class="Tcol atrasada">
                    <?php
                    $motivacion = $usuarioActual['motivacion'];
                    if ($motivacion == 0) {
                        echo "No aplica";
                    } else {
                        echo round($motivacion);
                        echo "%";
                    }
                    ?>
                </th>
            </tr>
        </table>
        <br>
        <p class="poppins semibold cblue">Estado de mis tareas</p>
        <table class="poppins RTpersonal">
            <tr class="RTrow">
                <th class="RTcol">Tareas Completas</th>
                <th class="RTcol">Tareas con atraso</th>
            </tr>
            <tr class="RTrow">
                <th class="RTrow"><?php echo $tareasRealizadas ?>/<?php echo $tareasTotales ?></th>
                <th class="RTrow"><?php echo $tareasAtrasadas ?></th>
            </tr>
            <tr class="RTrow">
                <th class="RTrow">Horas Realizadas</th>
                <th class="RTrow">Horas atrasadas</th>
            </tr>
            <tr class="RTrow">
                <th class="RTrow"><?php echo $horasReales ?></th>
                <th class="RTrow"><?php echo $horasAtrasadas ?></th>
            </tr>
        </table>
        <br>
        <p class="poppins">Aqui aparecera un mensaje de estado
            personal referente a como se desarrolla el alumno</p>
    </div>
</div>