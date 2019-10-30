<?php

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

$infoUsuarios = array();

foreach ($participantes as $p) {
    $consulta = $usuario->getUsuarioID($p);
    foreach ($consulta as $c) {

        $idUsuario = $c['_id'];
        array_push($infoUsuarios, $idUsuario);
    }
}

$listaUsuarios = $usuario->getUsuario();


?>


<form action="../controller/agregarTarea.php" class="poppins" method="POST" enctype="multipart/form-data">
    <label for="NTname">Nombre de tarea:</label>
    <input type="text" id="NTname" name="nombreTarea" placeholder="Aqui aparecera el nombre de la tarea">
    <label for="listResponsables">Responsable de la tarea:</label>
    <select name="listResponsables">
        <?php foreach ($listaUsuarios as $lu) : ?>
            <?php foreach ($infoUsuarios as $iu) : ?>
                <?php if ($lu['_id'] == $iu) : ?>
                    <option value="<?php echo $lu['_id']; ?>"><?php echo $lu['name']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </select>

    <label for="listTipoTarea">Tipo de tarea:</label>
    <select name="listTipoTarea">
        <option value="0">Tarea de proyecto</option>
        <option value="1">Tarea Extra</option>
    </select>

    <label for="NTfecha">Fecha de entrega:</label>
    <input type="date" id="NTfecha" name="fechaEntrega" value="<?php echo date('Y-m-d'); ?>">

    <label for="NThoras">Horas de trabajo asignadas:</label>
    <input type="number" id="Nthoras" name="horasTareas" placeholder="Horas estimadas para la tarea">

    <input type="submit" value="Agregar Tarea">
</form>