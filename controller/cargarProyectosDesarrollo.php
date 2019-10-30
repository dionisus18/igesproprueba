<?php
/* los proyectos con estado 0 se consideran en desarrollo */
include_once '../model/proyectos.php';
include_once '../model/usuarios.php';
$proyectos = new proyectos();
$listaProyectos = $proyectos->getProyectos();
$usuarios = new Usuarios();
$idUsuario = $_SESSION['idUsuario'];
$listaUsuario = $usuarios->getUsuarioID($idUsuario);

$ArrayProyectosUsuario = array();

foreach ($listaUsuario as $lu){
    foreach($lu['idProyectos'] as $lpu2){
        array_push($ArrayProyectosUsuario, $lpu2);
    }
}

$arrayViewProyect = array();

foreach($listaProyectos as $lp){
    foreach($ArrayProyectosUsuario as $apu){
        if($lp['_id'] == $apu){
           array_push($arrayViewProyect, $lp);
        }
    }
}

?>

<?php foreach ($arrayViewProyect as $fila) :
    if ($fila['estadoProyecto'] == 0) : ?>

        <tr class="filaNormal">
            <th class="Ncolf bold"><?php echo $fila['name'] ?></th>
            <th class="Ncol bold"><?php echo $fila['tareasRealizadas']."/".$fila['tareasProyecto'] ?></th>
            <th class="Ncol bold">Desarrollo</th>
            <th class="clickable-row bold btn" data-href="../controller/ingresoProyecto.php?idProyecto=<?php echo $fila['_id'] ?>">
                <a class="btnIngresar" href="#">Ingresar</a>
            </th>
            
        </tr>

        <tr class="space">
            <th class="colSpace"></th>
        </tr>

    <?php endif;
endforeach; ?>