<?php
include_once '../model/tareas.php';
$tareas = new Tareas();
$idTarea = $_SESSION['idTarea'];

$detalleTareas = $tareas->getDetalleTarea($idTarea);

?>

<form class="comentform poppins " action='../controller/agregarComentario.php' method="post" enctype="multipart/form-data">
    <label for="comentario">Comentarios:</label>
    <textarea name="TAC" placeholder="Escriba su comentario aqui" class="textCom"><?php echo $detalleTareas['comentario']; ?></textarea>
    <input class="cblue" type="submit" value="Guardar comentario" name="comentario">
</form>