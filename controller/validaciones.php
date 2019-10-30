<?php



    function camposVacios($string){
        $vacio=false;
        if(empty($string)){
            $vacio = true;
        }
        return $vacio;
    }

    function usuarioProyecto($idUsuario, $idProyecto){
        $permiso = false;
        include_once '../model/proyectos.php';
        $proyecto = new proyectos();
        $detalleProyecto = $proyecto->getProyectoInfo($idProyecto);

        foreach($detalleProyecto as $dp){
            foreach($dp['idParticipantes'] as $participante){
                if($participante == $idUsuario){
                    $permiso = true;
                }
            }
        }

        return $permiso;

    }


?>