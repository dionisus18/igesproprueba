<?php

include_once '../model/tareas.php';
$tareas = new Tareas();
$idTarea = $_SESSION['idTarea'];

$detalleTareas = $tareas->getDetalleTarea($idTarea);

?>

<form class="poppins" action='../controller/agregarArchivos.php' method="post" enctype="multipart/form-data">
    <label for="narch" class="inputlabel">Archivo adjunto:</label>
    <input type="text" name="filename" id="narch" value="<?php echo $detalleTareas['fileName']; ?>" placeholder="Aqui aparecera el nombre de su archivo" disabled>

    <div class="sdebtn">
        <input type="file" name="file" id="file" class="upload">
        <label for="file">Seleccionar archivo</label>

        <input class="cblue" type="submit" value="Descargar archivo" name="descargarArchivo">
        <input class="cred" type="submit" value="Eliminar archivo" name="eliminarArchivo">
    </div>
    <br>
    <label for="filedate">Fecha de subida:</label>
    <input type="text" id="filedate" name="filedate" value="<?php echo $detalleTareas['fileDate']; ?>" placeholder="Aqui aparecera la fecha de su archivo" disabled>
    <input type="submit" name="uploadFile" value="Subir Archivo">

</form>