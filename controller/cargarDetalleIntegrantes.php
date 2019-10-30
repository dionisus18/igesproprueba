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





    ?>

    <?php foreach ($infoUsuario as $iu) :
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
                if ($div == 0) {
                    $compromiso = 0;
                } else {
                    $compromiso = ($tareasRealizadas / ($tareasRealizadas + $tareasAtrasadas)) * 100;
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

            ?>
        <?php
                if ($tareasTotales == 0 && $horasPlanificadas == 0 && $tareasRealizadas == 0 && $horasReales == 0 && $tareasAtrasadas == 0) :

                else :

                    ?>

            <div class="DIwbox">
                <div class="cont">

                    <!-- Tabla con el nombre del integrante-->
                    <table class="poppins Nintegrante">
                        <tr>
                            <th class="DIPrincipal">Nombre Integrante:</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="DIcol DIPrincipal"><?php echo $iu['name']; ?></th>
                            <!--
                        <th class="clickable-row btn" data-href="#">
                            <a class="btnIngresar" href="#">ver Perfil</a>
                        </th>
        -->
                        </tr>
                    </table>
                    <!-- Tabla con los datos del integrante-->
                    <table class="poppins DIdatos">
                        <tr>
                            <th>Tareas responsables</th>
                            <th>Horas planificadas</th>
                            <th>Tareas realizadas</th>
                            <th>Horas realizadas</th>
                            <th>Tareas atrasadas</th>
                            <th>Compromiso</th>
                            <th>Organizacion</th>
                            <th>Motivacion</th>
                        </tr>
                        <tr>
                            <th class="DIdatoscol"><?php echo $tareasTotales; ?></th>
                            <th class="DIdatoscol"><?php echo $horasPlanificadas; ?></th>
                            <th class="DIdatoscol"><?php echo $tareasRealizadas; ?></th>
                            <th class="DIdatoscol"><?php echo $horasReales; ?></th>
                            <th class="DIdatoscol"><?php echo $tareasAtrasadas; ?></th>
                            <th class="DIdatoscol">
                                <?php
                                            if ($compromiso == 0) {
                                                echo "No aplica";
                                            } else {
                                                echo round($compromiso);
                                                echo "%";
                                            }

                                            ?>
                            </th>
                            <th class="DIdatoscol">
                                <?php
                                            if ($organizacion == 0) {
                                                echo "No aplica";
                                            } else {
                                                echo round($organizacion);
                                                echo "%";
                                            }
                                            ?>
                            </th>
                            <th class="DIdatoscol">
                                <?php
                                            if ($motivacion == 0) {
                                                echo "No aplica";
                                            } else {
                                                echo round($motivacion);
                                                echo "%";
                                            }
                                            ?>
                            </th>
                        </tr>
                    </table>
                    <!-- form privilegios-->
                    <!--
                <form class="DIpriv poppins">
                    <label>Nivel de privilegios:</label>
                    <select>
                        <option>Jefe de proyecto</option>
                        <option>Lider de proyecto</option>
                        <option>Miembro</option>
                        <input type="submit" value="Guardar" class="DIbtn">
                    </select>
                </form>
                                -->
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>