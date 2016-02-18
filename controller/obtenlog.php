<?php
    /* Object Oriented */
    // obtenTours.php
    $texto = "ERROR: ";

        $datos = json_decode($_REQUEST['info'], true);

        //archivo de configuracion
        include '../controller/config.php';

        $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
        //$conn = mysql_connect($hostdb, $usuariodb, $clavedb);

        /* comprobar la conexión */
        if (mysqli_connect_errno()) {
            echo $texto . mysqli_connect_error();
            /**printf("Falló la conexión: %s\n", mysqli_connect_error());**/
            exit();
        }

        //$consulta = "SELECT id_tour, nombre_tour, horario FROM tourhorario, tours WHERE tours.id_tour = tourhorario.id_tour GROUP BY id_tour";
        $consulta = 'SELECT r.id_reserva, r.id_cliente, r.clave_institucion, r.habitacion, r.num_adultos, r.num_ninos, r.num_insen FROM reserva r WHERE r.id_tour = '.$datos['id_tour']." AND r.horario = CAST('".$datos['id_horario']."' as TIME) AND r.fecha = CAST('".$datos['fecha']."' as DATE)";
        //$consulta = 'SELECT th.id_tour, t.nombre_tour, th.horario from tourhorario th, tours t WHERE th.id_tour = t.id_tour';
        

        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                //printf ("%s (%s)\n", $fila[0], $fila[1]);                                
                echo "<tr id=".$fila[0].">\n";//id
                    echo "<td>".$fila[1]."</td>\n";//Nombre cliente

                    $consulta_name = "SELECT i.nombre_hotel FROM institucion i WHERE i.clave_hotel = '".$fila[2]."'";
                    
                    if ($resultado_name = $mysqli->query($consulta_name)) {
                        $fila_name = $resultado_name->fetch_row();
                        echo "<td>".$fila_name[0]."</td>\n";//Clave Hotel
                    }else{
                        echo "<td>".$fila[2]."</td>\n";//Clave Hotel
                    }
                    echo "<td>".$fila[3]."</td>\n";//Num Habitacion
                    echo "<td>".$fila[4]."</td>\n";//adultos
                    echo "<td>".$fila[5]."</td>\n";//ninos
                    echo "<td>".$fila[6]."</td>\n";//insen
                echo "<tr>\n";
            }

            /* liberar el conjunto de resultados */
            $resultado->close();
        }
        /* cerrar la conexión */
        $mysqli->close();
?>