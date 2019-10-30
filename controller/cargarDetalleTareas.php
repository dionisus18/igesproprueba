<?php

include_once '../model/tareas.php';
$tareas = new Tareas();
$idTarea = $_SESSION['idTarea'];

$detalleTareas = $tareas->getDetalleTarea($idTarea);

include_once '../model/usuarios.php';
include_once '../model/proyectos.php';
$usuario = new Usuarios();
$proyecto = new proyectos();

$idUsuario = $_SESSION['idUsuario'];
$idProyecto = $_SESSION['idProyecto'];

$infoProyecto = $proyecto->getProyectoInfo($idProyecto);
$participantes = array();

foreach ($infoProyecto as $ip) {
    foreach ($ip['idParticipantes'] as $ipar) {
        array_push($participantes, $ipar);
    }
}


$listaUsuarios = $usuario->getUsuario();
$owner = '';

foreach ($listaUsuarios as $or) {
    if ($or['_id'] == $detalleTareas['owner']) {
        $owner = $or['name'];
    }
}

?>

<div class="boxc">
    <p class="poppins semibold"><p class="poppins semibold"><?php echo $detalleTareas['name']  ?></p>
    </p>
    <br>
    <p class="poppins">Solo "<?php echo $owner; ?>" y el lider de proyecto pueden realizar cambios a esta tarea</p>
    <form action="../controller/UDTareas.php" class="poppins up3" method="POST" enctype="multipart/form-data">
        <label for="DTname">Nombre de tarea:</label>
        <input type="text" id="DTname" name="nombreTarea" value="<?php echo $detalleTareas['name'] ?>">
        <label for="listResponsables">Responsable de la tarea:</label>
        <select name="responsableTarea">

            <?php
            foreach ($participantes as $part) :
                $lu = $usuario->getOneUsuarioID($part);
                if ($detalleTareas['responsable'] == $part) : ?>
                    <option selected value="<?php echo $detalleTareas['responsable'] ?>"><?php echo $lu['name']; ?></option>
                <?php else : ?>
                    <option value="<?php echo $lu['_id'] ?>"><?php echo $lu['name']; ?></option>
                <?php endif; ?>

            <?php endforeach; ?>

        </select>
        <label for="DTestado">Estado de tarea:</label>
        <?php
        switch ($detalleTareas['estadoTarea']) {
            case '0':
                ?>
                <input type="text" id="DTestado" name="estadoTarea" value="Desarrollo" disabled>
            <?php
                break;
            case '1':
                ?>
                <input type="text" id="DTestado" name="estadoTarea" value="Atrasada" disabled>
            <?php
                break;
            case '2':
                ?>
                <input type="text" id="DTestado" name="estadoTarea" value="Revision" disabled>
            <?php
                break;
            case '3':
                ?>
                <input type="text" id="DTestado" name="estadoTarea" value="Completada" disabled>
            <?php
                break;
            default:
                ?>
                <input type="text" id="DTestado" name="estadoTarea" value="Error" disabled>
            <?php
        } ?>

            <div class="inline">
                <label for="DTFechaEntrega">Fecha de entrega estimada:</label>
                <input type="text" id="DTFechaEntrega" name="fechaEntrega" value="<?php echo $detalleTareas['fechaEntrega'] ?>">
                <label class="floatR" for="DTFechaEntrega">Fecha de Aprobacion:</label>
                <input class="floatR" type="text" id="DTFechaEntrega" name="fechaAprobacion" value="<?php echo $detalleTareas['fechaAprobacion'] ?>" disabled>
            </div>
            <br>
            <div class="inline2">
                <label for="DTFechaEntrega">Horas de trabajo asignadas:</label>
                <input type="text" id="DTFechaEntrega" name="horasAsignadas" value="<?php echo $detalleTareas['horasAsignadas'] ?>">
                <label class="floatR" for="DTFechaEntrega">Horas de trabajo reales:</label>
                <input class="floatR" type="text" id="DTFechaEntrega" name="horasReales" value="<?php echo $detalleTareas['horasReales'] ?>">
            </div>

            <input class="up2" type="submit" value="Modificar tarea" name="modificarTarea">
            <input class="up cred" type="submit" value="Eliminar tarea" name="eliminarTarea">
    </form>

</div>