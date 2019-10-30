<?php
include_once '../model/detalleUsuarios.php';
$detalles = new detalles();
$idParticipantes = $detalles->getParticipantes();

$contador = 0;
foreach ($idParticipantes as $cont) {
    $contador = $contador + 1;
}

include_once '../model/usuarios.php';
$usuario = new Usuarios();

include_once '../model/estados.php';
$estado = new Estados();
$idProyecto = $_SESSION['idProyecto'];
$horasRealizadasProyecto = $estado->horasRealizadas($idProyecto);

foreach ($idParticipantes as $ip) :

    $infoUsuario = $usuario->getUsuarioID($ip);
    foreach ($infoUsuario as $iu) :
        $tareasTotales = $detalles->tareasTotalesUsuario($iu['_id']);
        $horasPlanificadas = $detalles->horasPlanificadasUsuario($iu['_id']);
        $tareasRealizadas = $detalles->tareasRealizadasUsuario($iu['_id']);
        $horasReales = $detalles->horasRealizadasUsuario($iu['_id']);
        $tareasAtrasadas = $detalles->tareasAtrasadasUsuario($iu['_id']);
        $estadoOrganizacion = $detalles->organizacion($iu['_id']);
        if ($tareasTotales == 0) {
            $compromiso = 0;
        } else {
            $div = $tareasRealizadas + $tareasAtrasadas;
            if($div == 0){
                $compromiso = 0;
            }else{
                $compromiso = ($tareasRealizadas /($tareasRealizadas + $tareasAtrasadas)) * 100;
            }
            
        }
        if ($horasRealizadasProyecto == 0 or $contador == 0) {
            $motivacion = 0;
        } else {
            $motivacion = round(($horasReales / ($horasRealizadasProyecto / $contador)) * 100);
        }
        
        if ($tareasTotales == 0 || $estadoOrganizacion == 0) {
            $organizacion = 0;
        } else {
            $div = $tareasRealizadas + $tareasAtrasadas;
            if ($div == 0) {
                $organizacion = 0;
            } else {
                $organizacion = ($estadoOrganizacion / ($tareasRealizadas + $tareasAtrasadas)) * 100;
            }

        }

        $idUsuario = $iu['_id'];
        $usuario->insertarEstadoUsuario($idUsuario, $compromiso, $organizacion, $motivacion);
    endforeach;
endforeach;

$proyecto = new proyectos();

$total = $estado->totalTareas($idProyecto);
$proyecto->insertarTotalTareasProyecto($idProyecto, $total);
$tareasRealizadas = $estado->tareasRealizadas($idProyecto);
$proyecto->insertarTareasRealizadas($idProyecto, $tareasRealizadas);
