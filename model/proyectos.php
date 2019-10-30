<?php

class proyectos
{
    private $db;
    private $proyectos;

    public function __construct()
    {
        require_once 'conexion.php';
        $this->db = ConexionDB::conexionProyectos();
        $this->proyectos = array();
    }


    public function getProyectos()
    {
        $consulta = $this->db->find([]);
        $this->proyectos = $consulta;
        return $this->proyectos;
    }

    public function getProyectoID($codProyecto){
        $consulta = $this->db->findOne(
            ['codProyecto' => "$codProyecto"]
        );
        $this->proyectos = $consulta;
        return $this->proyectos;
    }

    public function getProyectoInfo($idProyecto){
        $consulta = $this->db->find(['_id' => new MongoDB\BSON\ObjectID($idProyecto)]);
        $this->proyectos = $consulta;
        return $this->proyectos;
    }

    public function insertarProyecto($name, $codProyecto, $idUsuario)
    {
        $this->db->insertOne(
            ['name' => "$name", 'codProyecto' => "$codProyecto", 'tareasProyecto' => '0', 'estadoProyecto' => '0', 'idParticipantes' => [], 'tareasRealizadas' => '0', 'proyOwner' => "$idUsuario", 'codigoGrupo' => '']
        );
    }

    public function insertarUsuarioProyecto($idUsuario,$idProyecto){
        $this->db->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($idProyecto)],
        [ '$push' => ['idParticipantes' => "$idUsuario"]]
        );
    }

    public function insertarTotalTareasProyecto($idProyecto,$tareasProyecto){
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idProyecto)],
            [ '$set' =>['tareasProyecto' => "$tareasProyecto"]]
        );
    }

    public function insertarTareasRealizadas($idProyecto,$tareasProyecto){
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idProyecto)],
            [ '$set' =>['tareasRealizadas' => "$tareasProyecto"]]
        );
    }

    public function insertarCodigoGrupo($idProyecto,$codGrupo){
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idProyecto)],
            [ '$set' =>['codigoGrupo' => "$codGrupo"]]
        );
    }
    public function modificarNombre($idProyecto,$name){
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idProyecto)],
            [ '$set' =>['name' => "$name"]]
        );
    }

    public function eliminarProyecto($idProyecto)
    {
        $this->db->deleteOne(['_id' => new MongoDB\BSON\ObjectID($idProyecto)]);
    }
    
}
