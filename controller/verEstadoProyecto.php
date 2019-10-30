
<?php
include_once '../model/estados.php';
include_once '../model/proyectos.php';
$estado = new Estados();
$proyecto = new proyectos();
session_start();
$idProyecto = $_SESSION['idProyecto'];


$total = $estado->totalTareas($idProyecto);
$proyecto->insertarTotalTareasProyecto($idProyecto, $total);
$tareasRealizadas = $estado->tareasRealizadas($idProyecto);
$proyecto->insertarTareasRealizadas($idProyecto,$tareasRealizadas);
$tareasEsperadas = $estado->tareasEsperadas($idProyecto);
$horasPlanificadas = $estado->horasPlanificadas($idProyecto);
$horasEsperadas = $estado->horasActuales($idProyecto);
$horasRealizadas = $estado->horasRealizadas($idProyecto);
$atrasadas= $estado->tareasAtrasadas($idProyecto);

$porcentajeAtraso = (1-($tareasRealizadas/$tareasEsperadas));

if($porcentajeAtraso < 0 || $tareasRealizadas == 0 || $tareasEsperadas == 0){
    $porcentajeAtraso = 0;
}
$horasAtraso = $estado->horasAtraso($idProyecto);


//$esperados = $tareas->tareasEsperadas($idProyecto, $date);
?>


<section class="EPsdash">
    <div class="EPproyectos">
        <p class="poppins extra">Estado de proyecto</p>
        <!-- Tabla de Estado 1 para cada estado -->
        <!-- Estado tareas totales -->
<table class="poppins listProy">
    <tr class="Principal">
        <th></th>
        <th>Planificadas</th>
        <th>Esperadas a la fecha</th>
        <th>Realizadas</th>
    </tr>
    <tr class="filaNormal">
        <th class="Ecol bold backgroundBlue">Tareas Totales</th>
        <th class="Ncol Ecol bold"><?php echo $total ?></th>
        <th class="Ncol Ecol bold"><?php echo $tareasEsperadas ?></th>
        <th class="Ncold Ecol bold"><?php echo $tareasRealizadas ?></th>

    </tr>

</table>
<!--Estado Horas totales -->
<table class="poppins listProy">
    <tr class="Principal">
        <th></th>
        <th>Planificadas</th>
        <th>Esperadas a la fecha</th>
        <th>Realizadas</th>
    </tr>
    <tr class="filaNormal">
        <th class="Ecol bold backgroundBlue">Horas Totales</th>
        <th class="Ncol Ecol bold"><?php echo $horasPlanificadas?></th>
        <th class="Ncol Ecol bold"><?php echo $horasEsperadas?></th>
        <th class="Ncold Ecol bold"><?php echo $horasRealizadas?></th>

    </tr>
</table>
<!-- Estado atrasos -->
<table class="poppins listProy">
    <tr class="Principal">
        <th></th>
        <th>Tareas atrasadas</th>
        <th>Duracion (Horas)</th>
        <th>Porcentaje de retraso</th>
    </tr>
    <tr class="filaNormal">
        <th class="Ecol bold backgroundBlue">Atrasos Totales</th>
        <th class="Ncol Ecol bold"><?php echo $atrasadas?></th>
        <th class="Ncol Ecol bold"><?php echo $horasAtraso ?></th>
        <th class="Ncold Ecol bold"><?php
        if($porcentajeAtraso == 0){
            echo '0';
        }else{
            echo round($porcentajeAtraso*100);
        }
         ?>%</th>
    </tr>
</table>
<!-- Fin de la tabla de estados -->
</div>
</section>

<section class="EPsection">
    <div class="wbox">
        <div class="cont">
            <p class="poppins semibold"> Porcentaje de proyecto esperado</p>
            <p class="poppins big"><?php
            if($tareasEsperadas == 0 || $total == 0){
                echo '0';
            }else{
                echo round(($tareasEsperadas/$total)*100); 
            }
             ?>%</p>
        </div>
    </div>

    <div class="wbox wbox2">
        <div class="cont">
            <p class="poppins semibold"> Porcentaje de proyecto
                realizado</p>
            <p class="poppins big"><?php
            if($tareasRealizadas == 0 || $total == 0){
                echo '0';
            }else{
                echo round(($tareasRealizadas/$total)*100); 
            }
             ?>%</p>
        </div>
    </div>
</section>

