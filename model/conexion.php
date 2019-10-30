<?php

use MongoDB\Exception\Exception;

require '../vendor/autoload.php';

class ConexionDB
{

    public static function conexionProyectos()
    {
        try {
            //$client = new MongoDB\Client('mongodb://igespro-8023:HKnorwZqlmiaGLojzAnQRyPTWuUuVS@db-igespro-8023.nodechef.com:5360/igespro');
            $client = new MongoDB\Client(
                'mongodb+srv://erkortar:Pass_mg$1@cluster0-3lg8p.mongodb.net/Prueba?retryWrites=true&w=majority');            
            $GESPRO = $client->Prueba;
            $proyectos = $GESPRO->Proyectos;
        } catch (Exception $err) {
            throw $err;
        }
        return $proyectos;
    }

    public static function conexionUsuarios()
    {
        try {
            $client = new MongoDB\Client(
                'mongodb+srv://erkortar:Pass_mg$1@cluster0-3lg8p.mongodb.net/Prueba?retryWrites=true&w=majority');
                $GESPRO = $client->Prueba;
            $usuarios = $GESPRO->Usuarios;
        } catch (Exception $err) {
            throw "Hello".$err;
        }
        return $usuarios;
    }

    public static function conexionTareas()
    {
        try {
            $client = new MongoDB\Client(
                'mongodb+srv://erkortar:Pass_mg$1@cluster0-3lg8p.mongodb.net/Prueba?retryWrites=true&w=majority');
            $GESPRO = $client->Prueba;
            $tareas = $GESPRO->Tareas;
        } catch (Exception $err) {
            throw $err;
        }
        return $tareas;
    }
}
