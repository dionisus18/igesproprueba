<?php

use MongoDB\BSON\ObjectId;

require '../vendor/autoload.php';

class Estados
{
    private $db;
    private $estado;

    public function __construct()
    {
        require_once 'conexion.php';
        $this->db = ConexionDB::conexionTareas();
        $this->estado = array();
    }


    public function totalTareas($idProyecto) {
        $contador = 0;
        $result=  $this->db->find();

        foreach ($result as $r){
            if($r['idProyecto']==$idProyecto){
                $contador = $contador +1;
            }

        }
        $this->estado = $contador;
        return $this->estado;
    }

    public function tareasRealizadas($idProyecto){
        $contador = 0;
        $result=  $this->db->find();

        foreach ($result as $r){
            if(($r['idProyecto']==$idProyecto)){
                if($r['estadoTarea'] == '2' or $r['estadoTarea'] == '3'){
                    $contador = $contador +1;
                }
            }
        }
        $this->estado = $contador;
        return $this->estado;
    }

    public function tareasEsperadas($idProyecto){
        $date = date('Y-m-d')."\n";

        $contador = 0;
        $result=  $this->db->find();

        foreach ($result as $r){
            if(($r['idProyecto']==$idProyecto)){
                if($r['fechaEntrega'] < $date){
                    $contador = $contador +1;
                }
            }
        }
        $this->estado = $contador;
        return $this->estado;
    }

    public function horasPlanificadas($idProyecto){
        $contador = 0;
        $result=  $this->db->find();

        foreach ($result as $r){
            if(($r['idProyecto']==$idProyecto)){
                $contador = $contador + ((int)$r['horasAsignadas']);
            }
        }
        $this->estado = $contador;
        return $this->estado;
    }

    public function  horasActuales($idProyecto) {
        $date = date('Y-m-d')."\n";
        $contador = 0;
        $result=  $this->db->find();

        foreach ($result as $r){
            if(($r['idProyecto']==$idProyecto)){
                if($r['fechaEntrega'] < $date){

                    $contador = $contador + ((int)$r['horasAsignadas']);
                }
            }
        }
        $this->estado = $contador;
        return $this->estado;
    }

    public function horasRealizadas($idProyecto){
        
        $contador = 0;
        $result=  $this->db->find();

        foreach ($result as $r){
            if(($r['idProyecto']==$idProyecto)){
                

                    $contador = $contador + ((int)$r['horasReales']);
                
            }
        }
        $this->estado = $contador;
        return $this->estado;
    }

    public function tareasAtrasadas($idProyecto){

        /*
        $realizadas = $this->tareasRealizadas($idProyecto);
        $esperadas = $this->tareasEsperadas($idProyecto);

        $resultado = $esperadas-$realizadas;

        if($resultado < 0){
            $resultado=0;
        }else{
            $resultado;
        }
        $this->estado = $resultado;
        return $this->estado;
        */
        include_once 'tareas.php';
        $tarea = new Tareas();
        $infoTarea = $tarea->getTareas($idProyecto);
        $contador = 0;
        foreach($infoTarea as $it){
            if($it['estadoTarea'] == '1'){
                $contador = $contador + 1;
            }
            
        }

        $this->estado = $contador;
        return $this->estado;
    }

    public function horasAtraso($idProyecto){
        $date = date('Y-m-d')."\n";

        $contador = 0;
        $result=  $this->db->find();

        foreach ($result as $r){
            if(($r['idProyecto']==$idProyecto)){
                if($r['fechaEntrega'] < $date){
                    if($r['estadoTarea'] == 1){
                        $contador = $contador + ((int)$r['horasAsignadas']);
                    }
                }
            }
        }
        $this->estado = $contador;
        return $this->estado;
    }




}

?>