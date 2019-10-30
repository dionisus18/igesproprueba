<?php
require '../vendor/autoload.php';

class Tareas
{

    private $db;
    private $tareas;

    public function __construct()
    {
        require_once 'conexion.php';
        $this->db = ConexionDB::conexionTareas();
        $this->tareas = array();
    }

    public function getTareas($idProyecto)
    {
        $consulta = $this->db->find(['idProyecto' => "$idProyecto"]);
        $this->tareas = $consulta;
        return $this->tareas;
    }

    public function getDetalleTarea($idTarea)
    {

        $consulta = $this->db->findOne(['_id' => new MongoDB\BSON\ObjectID($idTarea)]);
        $this->tareas = $consulta;
        return $this->tareas;
    }

    public function insertarTarea($name, $idProyecto, $responsable, $tipoTarea, $fechaEntrega, $horasAsignadas, $idUsuario)
    {
        $this->db->insertOne(
            ['name' => "$name", 'idProyecto' => "$idProyecto", 'responsable' => "$responsable", 'tipoTarea' => "$tipoTarea", 'fechaEntrega' => "$fechaEntrega", 'horasAsignadas' => "$horasAsignadas", 'estadoTarea' => '0', 'horasReales' => '0', 'comentario' => '', 'fileName' => '', 'fileDir' => '', 'fileDate' => '', 'owner' => "$idUsuario", 'fechaAprobacion' => 'No aprobado']
        );
    }

    public function eliminarTarea($idTarea)
    {
        $this->db->deleteOne(['_id' => new MongoDB\BSON\ObjectID($idTarea)]);
    }

    public function modificarTarea($idTarea, $name, $responsable, $fechaEntrega, $horasAsignadas, $horasReales)
    {
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idTarea)],
            ['$set' => ['name' => "$name", 'responsable' => "$responsable", 'fechaEntrega' => "$fechaEntrega", 'horasAsignadas' => "$horasAsignadas", 'horasReales' => "$horasReales"]]
        );
    }

    public function aprobarTarea($idTarea)
    {
        $date = date('Y-m-d');
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idTarea)],
            ['$set' => ['estadoTarea' => '3', 'fechaAprobacion' => "$date"]]
        );
    }

    public function CambiarEstadoTarea($idTarea, $estado)
    {
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idTarea)],
            ['$set' => ['estadoTarea' => "$estado"]]
        );
    }


    public function TareaAtrasada()
    {
        $idProy = $_SESSION['idProyecto'];
        $revisionAtrasos = $this->getTareas($idProy);

        //$date = date('Y-m-d') . "\n";
        $date = date('Y-m-d');

        foreach ($revisionAtrasos as $ra) :
            if (($ra['idProyecto'] == $idProy)) {
                if ($ra['fechaEntrega'] < $date) {
                    if ($ra['estadoTarea'] == '0') {

                        $this->db->updateOne(
                            ['_id' => new MongoDB\BSON\ObjectID($ra['_id'])],
                            ['$set' => ['estadoTarea' => "1"]]
                        );
                    }
                }
            }
        endforeach;
    }

    public function getTareasUsuario($idUsuario)
    {
        $consulta = $this->db->find(['responsable' => "$idUsuario"]);
        $this->tareas = $consulta;
        return $this->tareas;
    }

    public function agregarComentario($idTarea, $comentario)
    {
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idTarea)],
            ['$set' => ['comentario' => "$comentario"]]
        );
    }

    public function agregarArchivo($idTarea, $fileName, $fileDate, $fileDir)
    {
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idTarea)],
            ['$set' => ['fileName' => "$fileName", 'fileDate' => "$fileDate", 'fileDir' => "$fileDir"]]
        );
    }
}
