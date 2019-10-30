<?php 
include_once "../model/proyectos.php";

$proy = new proyectos();
$idProyecto = $_SESSION['idProyecto'];

$detalleProyecto = $proy->getProyectoInfo($idProyecto);

foreach($detalleProyecto as $dp):
$nombreProyecto = $dp['name'];
$codigoProyecto = $dp['codProyecto'];
$codigoGrupo = $dp['codigoGrupo'];
$owner = $dp['proyOwner'];
endforeach;

include_once "../model/usuarios.php";
$usuario = new Usuarios();
$detalleUsuario = $usuario->getUsuarioID($owner);
foreach($detalleUsuario as $du){
$liderProyecto = $du['name'];
}
?>

<div id="my-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <br>
        </div>
        <div class="modal-body">
            <div class="modal-comp">

                <p class="poppins bold">Informacion del proyecto</p>
                <p class="poppins">Solo el lider de proyecto, "<?php echo $liderProyecto ?>"" puede realizar cambios o eliminar el proyecto</p>
                <br>
                <form class="poppins" action='../controller/UDProyecto.php' method="post" enctype="multipart/form-data">
                    <label for="mnpro" class="inputlabel poppins">Nombre del proyecto:</label>
                    <input type="text" name="nombreProyecto" id="mnpro" value="<?php echo $nombreProyecto; ?>">
                    <label for="mcpro" class="inputlabel poppins">Codigo Proyecto:</label>
                    <input type="text" name="modalCProy" id="mcpro" value="<?php echo $codigoProyecto; ?>" disabled>
                    <label for="mcgpro" class="inputlabel poppins">Codigo de grupo de proyectos:</label>
                    <input type="text" name="codigoGrupo" id="mcgpro" value="<?php echo $codigoGrupo; ?>" placeholder="Tu proyecto no se encuentra agrupado">
                    <p class="poppins">· El codigo de grupo de proyectos te permitira registrar tu proyecto en un subconjunto de proyectos</p>
                    <p class="poppins">· Para poder eliminar un proyecto deberas primero eliminar todas sus tareas</p>
                    <br><br>
                    <input type="submit" value="Modificar Proyecto" name="modificarProyecto"><br><br>
                    <input class="cred" type="submit" value="Eliminar Proyecto" name="eliminarProyecto">

                </form>
            </div>
        </div>
    </div>
</div>
