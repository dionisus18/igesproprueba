<?php

if (isset($_POST['uploadFile'])) {
    session_start();
    include_once 'validaciones.php';
    $idUsuario = $_SESSION['idUsuario'];
    $idProyecto = $_SESSION['idProyecto'];
    $permiso = usuarioProyecto($idUsuario, $idProyecto);

    if ($permiso == true) :

        include_once '../model/tareas.php';
        $tareas = new Tareas();
        $idTarea = $_SESSION['idTarea'];
        $detalleTareas = $tareas->getDetalleTarea($idTarea);
        if ($detalleTareas['fileName'] == '' || empty($detalleTareas)) {
            require '../model/S3.php';

            define('AWS_S3_KEY', 'AKIAJ4PV6NDPZGYYEGDA');
            define('AWS_S3_SECRET', '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');
            define('AWS_S3_REGION', 'us-east-1');
            define('AWS_S3_BUCKET', 'gesproacademy');
            define('AWS_S3_URL', 'http://s3.' . AWS_S3_REGION . '.amazonaws.com/' . AWS_S3_BUCKET . '/');


            $tmpfile = $_FILES['file']['tmp_name'];
            $file = $_FILES['file']['name'];
            $fileDate = date('Y-m-d', time());

            $fileName = preg_replace('/\s+/', '_', $file);

            if (defined('AWS_S3_URL')) {
                // Persist to AWS S3 and delete uploaded file

                S3::setAuth(AWS_S3_KEY, AWS_S3_SECRET);
                S3::setRegion(AWS_S3_REGION);
                S3::setSignatureVersion('v4');
                S3::putObject(S3::inputFile($tmpfile), AWS_S3_BUCKET, 'archivosTareas/' . $idTarea . '/' . $fileName, S3::ACL_PUBLIC_READ_WRITE);
                $tareas->agregarArchivo($idTarea, $fileName, $fileDate, AWS_S3_BUCKET);
                $estado = "2";
                $tareas->CambiarEstadoTarea($idTarea, $estado);

                header('location:../view/detalleTareas.php');
            }
        } else {
            header('location:../view/detalleTareas.php'); // ya hay un archivo subido
        } else :
        header('location:../view/detalleTareas.php'); // No tiene permisos
    endif;
} else if (isset($_POST['descargarArchivo'])) {
    include_once '../model/tareas.php';
    session_start();
    $tareas = new Tareas();
    $idTarea = $_SESSION['idTarea'];
    $detalleTareas = $tareas->getDetalleTarea($idTarea);

    if ($detalleTareas['fileName'] == '' || empty($detalleTareas['fileName'])) {
        header('location:../view/detalleTareas.php'); //no existe el archivo
    } else {

        require '../model/S3.php';
        $fileName = $detalleTareas['fileName'];


        define('AWS_S3_KEY', 'AKIAJ4PV6NDPZGYYEGDA');
        define('AWS_S3_SECRET', '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');
        define('AWS_S3_REGION', 'us-east-1');
        define('AWS_S3_BUCKET', 'gesproacademy');
        define('AWS_S3_URL', 'http://s3.' . AWS_S3_REGION . '.amazonaws.com/' . AWS_S3_BUCKET . '/');

        $archivo = 'https://gesproacademy.s3.amazonaws.com/archivosTareas/' . $idTarea . '/' . $fileName;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        //header('Content-Length: ' . filesize($archivo));
        readfile($archivo);
    }
} else if (isset($_POST['eliminarArchivo'])) {
    session_start();
    include_once 'validaciones.php';
    $idUsuario = $_SESSION['idUsuario'];
    $idProyecto = $_SESSION['idProyecto'];
    $permiso = usuarioProyecto($idUsuario, $idProyecto);
    if ($permiso == true) :

        include_once '../model/tareas.php';
        $tareas = new Tareas();
        $idTarea = $_SESSION['idTarea'];

        $detalleTareas = $tareas->getDetalleTarea($idTarea);
        if ($detalleTareas['fileName'] == '' || empty($detalleTareas['fileName'])) {
            header('location:../view/detalleTareas.php'); //no existe el archivo
        } else {

            require '../model/S3.php';
            $fileName = $detalleTareas['fileName'];

            define('AWS_S3_KEY', 'AKIAJ4PV6NDPZGYYEGDA');
            define('AWS_S3_SECRET', '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');
            define('AWS_S3_REGION', 'us-east-1');
            define('AWS_S3_BUCKET', 'gesproacademy');
            define('AWS_S3_URL', 'http://s3.' . AWS_S3_REGION . '.amazonaws.com/' . AWS_S3_BUCKET . '/');


            S3::deleteObject(AWS_S3_BUCKET, 'archivosTareas/' . $idTarea . '/' . $fileName);


            $tareas->agregarArchivo($idTarea, "", "", "");
            $estado = "0";
            $tareas->CambiarEstadoTarea($idTarea, $estado);
            header('location:../view/detalleTareas.php');
        } else :
        header('location:../view/detalleTareas.php'); // No tiene permisos
    endif;
} else {
    header('location:../view/detalleTareas.php');
}
