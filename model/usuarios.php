
<?php 
require '../vendor/autoload.php';

class Usuarios{

    private $db;
    private $usuario;

    public function __construct()
    {
        require_once 'conexion.php';
        $this->db = ConexionDB::conexionUsuarios();
        $this->usuario = array();
    }


    public function getUsuario(){
        $consulta = $this->db->find([]);
        $this -> usuario =$consulta;
        return $this->usuario;

    }

    public function findUsuario($email){
        $consulta = $this->db->findOne(['email' => "$email"]);
        $this -> usuario =$consulta;
        return $this->usuario;
    }

    public function getUsuarioID($idUsuario){

        $consulta = $this->db->find(['_id' => new MongoDB\BSON\ObjectID($idUsuario)]);
        $this->usuario = $consulta;
        return $this->usuario;
    }

    public function getOneUsuarioID($idUsuario){

        $consulta = $this->db->findOne(['_id' => new MongoDB\BSON\ObjectID($idUsuario)]);
        $this->usuario = $consulta;
        return $this->usuario;
    }

    public function insertarUsuarios($name, $email, $pass){

        $this->db->insertOne(
            [ 'name' => "$name", 'email' => "$email", 'pass' => "$pass", 'idProyectos' => [], 'compromiso' => "", 'organizacion' => "", 'motivacion' => "", 'grupoProyectos' => []]
        );

        
    }

    public function insertarProyectoUsuario($idProyecto,$idUsuario){

        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idUsuario)],
            [ '$push' => ['idProyectos' => "$idProyecto"]]
        );
    }

    public function eliminarProyectoUsuario($idProyecto,$idUsuario){

        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idUsuario)],
            [ '$pull' => ['idProyectos' => "$idProyecto"]]
        );
    }


    public function insertarEstadoUsuario($idUsuario, $compromiso, $organizacion, $motivacion)
    {

        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idUsuario)],
            ['$set' => ['compromiso' => "$compromiso", 'organizacion' => "$organizacion", 'motivacion' => "$motivacion"]]
        );
    }

    public function insertarCodigoGrupalUsuario($codGrupal,$idUsuario){

        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idUsuario)],
            [ '$push' => ['grupoProyectos' => "$codGrupal"]]
        );
    }

    public function eliminarCodigoGrupalUsuario($codGrupal,$idUsuario){

        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($idUsuario)],
            [ '$pull' => ['grupoProyectos' => "$codGrupal"]]
        );
    }


    public function cambiarPass($id,$pass)
    {       
        $this->db->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($id)],
            ['$set' => ['pass' => "$pass"]]
        );
    }


}

?>

