<?php

include_once '../model/proyectos.php';

$proyecto = new proyectos();
if (!session_id()) {
    session_start();
}
$idProyecto = $_SESSION['idProyecto'];

$infoProyecto = $proyecto->getProyectoInfo($idProyecto);
foreach($infoProyecto as $ip):
?>

<p class="poppins extra"> <?php echo $ip['name'] ?></p><br>

<?php endforeach; ?>