<?php

include_once '../model/tareas.php';
include_once '../model/usuarios.php';
$tareas = new Tareas();
$usuario = new Usuarios();
$tareas->TareaAtrasada();
$idProy = $_SESSION['idProyecto'];
$listaTareas = $tareas->getTareas($idProy);
$listaUsuarios = $usuario->getUsuario();

?>

<?php foreach ($listaTareas as $fila) : ?>
    <?php if ($fila['tipoTarea'] == 1) : ?>
        <tr class="filaNormal">
            <td class="Tcol1" style="width:500px;"><?php echo $fila['name'] ?></td>


            <?php $usuarioEspecifico = $usuario->getOneUsuarioID($fila['responsable']); ?>

            <td class="Tcol" style="vertical-align:middle;"><?php echo $usuarioEspecifico['name'] ?></td>



            <?php
            switch ($fila['estadoTarea']) {
                case '0':
                    ?>
                <td class="Tcol" style="vertical-align:middle;">Desarrollo</td>
                <?php
                break;
            case '1':
                ?>
                <td class="Tcol atrasada" style="vertical-align:middle;">Atrasada</td>
                <?php
                break;
            case '2':
                ?>
                <td class="Tcol revision" style="vertical-align:middle;">Revision</td>
                <?php
                break;
            case '3':
                ?>
                <td class="Tcol completa" style="vertical-align:middle;">Completa</td>
                <?php
                break;
            default:
                ?>
                <td class="Tcol atrasada" style="vertical-align:middle;">Error</td>
            <?php
        } ?>


            <td class="clickable-row btn Tcol" data-href="../controller/ingresoTareas.php?idTarea=<?php echo $fila['_id'] ?>" style="vertical-align:middle;">
                <a class="btnIngresar" href="#">Ver detalles</a>
            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>