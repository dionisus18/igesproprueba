<?php
include_once '../model/usuarios.php';
$usuario = new Usuarios();
$idUsuario = $_SESSION['idUsuario'];
$detalleUsuario = $usuario->getUsuarioID($idUsuario);

?>


<form action="../controller/eliminarCodigoGrupal.php" class="poppins" method="POST" enctype="multipart/form-data">
    <label for="codGrupal">Tus Codigos Grupales:</label>
    <select name="codigosGrupalesUsuario">
        <option selected>Selecciona un codigo Grupal...</option>
        <?php
        foreach ($detalleUsuario as $du) :
            foreach ($du['grupoProyectos'] as $gp) :
                ?>
                <option value="<?php echo $gp; ?>"><?php echo $gp; ?></option>
        <?php
            endforeach;
        endforeach;

        ?>
    </select>
    <input class="cred" type="submit" value="Eliminar tu codigo grupal" name="eliminarCG">
</form>