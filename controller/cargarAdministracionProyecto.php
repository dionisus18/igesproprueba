<?php
include_once '../model/proyectos.php';
include_once '../model/usuarios.php';
$proyectos = new proyectos();
$listaProyectos = $proyectos->getProyectos();
$usuarios = new Usuarios();
$idUsuario = $_SESSION['idUsuario'];
$listaUsuario = $usuarios->getUsuarioID($idUsuario);

$ArrayProyectosUsuario = array();

foreach ($listaUsuario as $lu) {
    foreach ($lu['grupoProyectos'] as $lpu2) {
        array_push($ArrayProyectosUsuario, $lpu2);
    }
}

$arrayViewProyect = array();

foreach ($listaProyectos as $lp) {
    foreach ($ArrayProyectosUsuario as $apu) {
        if ($lp['codigoGrupo'] == $apu) {
            array_push($arrayViewProyect, $lp);
        }
    }
}

function cmp ($a, $b){
    return strcmp($a->codigoGrupo, $b->codigoGrupo);
}

usort($arrayViewProyect, "cmp");

$CGactual = "";
?>

<?php foreach ($arrayViewProyect as $fila) :
    if ($fila['estadoProyecto'] == 0) :
        if ($CGactual != $fila['codigoGrupo']) :
            $CGactual = $fila['codigoGrupo'];
            ?>

            <!-- Tabla de proyectos -->

            <div class="proyectos">
                <p class="poppins bold"> Codigo Grupal: </p>
                <p class="poppins bold"><?php echo $CGactual; ?></p>

                <table class="poppins listProy">
                    <!-- lista de nombre de columnas -->
                    <tr class="Principal">
                        <th>Nombre</th>
                        <th>Tareas</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>

                    <?php foreach ($arrayViewProyect as $fila) :
                                    if ($fila['estadoProyecto'] == 0) :
                                        if ($CGactual == $fila['codigoGrupo']) :
                                            ?>

                                <tr class="filaNormal">
                                    <th class="Ncolf bold"><?php echo $fila['name'] ?></th>
                                    <th class="Ncol bold"><?php echo $fila['tareasRealizadas'] . "/" . $fila['tareasProyecto'] ?></th>
                                    <th class="Ncol bold">Desarrollo</th>
                                    <th class="clickable-row bold btn" data-href="../controller/ingresoProyecto.php?idProyecto=<?php echo $fila['_id'] ?>">
                                        <a class="btnIngresar" href="#">Ingresar</a>
                                    </th>

                                </tr>

                                <tr class="space">
                                    <th class="colSpace"></th>
                                </tr>

                    <?php endif;
                                    endif;
                                endforeach; ?>

                </table>

            </div>



<?php
        endif;
    endif;
endforeach; ?>