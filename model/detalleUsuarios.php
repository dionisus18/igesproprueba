<?php

use MongoDB\BSON\ObjectId;

require '../vendor/autoload.php';

class detalles
{
    private $db;
    private $detalles;

    public function __construct()
    {
        require_once 'conexion.php';
        $this->db = ConexionDB::conexionTareas();
        $this->detalles = array();
    }


    public function getParticipantes()
    {
        include_once 'proyectos.php';
        $proyecto = new proyectos();
        if (!session_id()) {
            session_start();
        }
        $idProyecto = $_SESSION['idProyecto'];

        $infoProyecto = $proyecto->getProyectoInfo($idProyecto);
        $integrantes = array();

        foreach ($infoProyecto as $ip) {
            foreach ($ip['idParticipantes'] as $ipart) {
                $idparti = $ipart;
                array_push($integrantes, $ipart);
            }
        }
        $this->detalles = $integrantes;
        return $this->detalles;
    }

    public function tareasTotalesUsuario($idUsuario)
    {
        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareasUsuario($idUsuario);
        $contador = 0;


        $participantes = $this->getParticipantes();

        $idProyecto = $_SESSION['idProyecto'];


        foreach ($infoTarea as $it) {
            foreach ($participantes as $p) {
                if ($p == $it['responsable'] and $it['idProyecto'] == $idProyecto) {
                    $contador = $contador + 1;
                }
            }
        }



        $this->detalles = $contador;
        return $this->detalles;
    }

    public function horasPlanificadasUsuario($idUsuario)
    {

        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareasUsuario($idUsuario);
        $contador = 0;

        $participantes = $this->getParticipantes();

        $idProyecto = $_SESSION['idProyecto'];

        foreach ($infoTarea as $it) {
            foreach ($participantes as $p) {
                if ($p == $it['responsable'] and $it['idProyecto'] == $idProyecto) {
                    $contador = $contador + ((int) $it['horasAsignadas']);
                }
            }
        }





        $this->detalles = $contador;
        return $this->detalles;
    }

    public function organizacion($idUsuario)
    {

        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareasUsuario($idUsuario);
        $contador = 0;

        $idProyecto = $_SESSION['idProyecto'];

        foreach ($infoTarea as $i) {
            if ($i['idProyecto'] == $idProyecto) {
                if (empty($i['fileDate']) && $i['fechaAprobacion'] == "No aprobado") { } else {

                    if ((!empty($i['fileDate']) && $i['fechaEntrega'] >= $i['fileDate']) || $i['fechaEntrega'] >= $i['fechaAprobacion']) {
                        $contador = $contador + 1;
                    }
                }
            }
        }



        $this->detalles = $contador;
        return $this->detalles;
    }

    public function tareasRealizadasUsuario($idUsuario)
    {
        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareasUsuario($idUsuario);
        $contador = 0;

        $participantes = $this->getParticipantes();

        $idProyecto = $_SESSION['idProyecto'];

        foreach ($infoTarea as $it) {
            foreach ($participantes as $p) {
                if ($p == $it['responsable'] and $it['idProyecto'] == $idProyecto) {
                    if ($it['estadoTarea'] == '2' or $it['estadoTarea'] == '3') {
                        $contador = $contador + 1;
                    }
                }
            }
        }



        $this->detalles = $contador;
        return $this->detalles;
    }
    public function horasRealizadasUsuario($idUsuario)
    {

        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareasUsuario($idUsuario);
        $contador = 0;

        $participantes = $this->getParticipantes();

        $idProyecto = $_SESSION['idProyecto'];

        foreach ($infoTarea as $it) {
            foreach ($participantes as $p) {
                if ($p == $it['responsable'] and $it['idProyecto'] == $idProyecto) {
                    $contador = $contador + ((int) $it['horasReales']);
                }
            }
        }




        $this->detalles = $contador;
        return $this->detalles;
    }
    public function tareasAtrasadasUsuario($idUsuario)
    {

        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareasUsuario($idUsuario);
        $contador = 0;

        $participantes = $this->getParticipantes();

        $idProyecto = $_SESSION['idProyecto'];

        foreach ($infoTarea as $it) {
            foreach ($participantes as $p) {
                if ($p == $it['responsable'] and $it['idProyecto'] == $idProyecto) {
                    if ($it['estadoTarea'] == '1') {
                        $contador = $contador + 1;
                    }
                }
            }
        }





        $this->detalles = $contador;
        return $this->detalles;
    }

    public function horasAtrasadasUsuario($idUsuario)
    {

        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareasUsuario($idUsuario);
        $contador = 0;

        $participantes = $this->getParticipantes();

        $idProyecto = $_SESSION['idProyecto'];

        foreach ($infoTarea as $it) {
            foreach ($participantes as $p) {
                if ($p == $it['responsable'] and $it['idProyecto'] == $idProyecto) {
                    if ($it['estadoTarea'] == '1') {
                        $contador = $contador + ((int) $it['horasAsignadas']);
                    }
                }
            }
        }





        $this->detalles = $contador;
        return $this->detalles;
    }
}
