<?php
/* Object Oriented */
// obtenTours.php
$texto = "ERROR: ";

    //archivo de configuracion
    include 'config.php';

    $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
    //$conn = mysql_connect($hostdb, $usuariodb, $clavedb);

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo $texto . mysqli_connect_error();
        /**printf("Falló la conexión: %s\n", mysqli_connect_error());**/
        exit();
    }

    //$consulta = "SELECT id_tour, nombre_tour, horario FROM tourhorario, tours WHERE tours.id_tour = tourhorario.id_tour GROUP BY id_tour";
    $consulta = 'SELECT th.id_tour, t.nombre_tour, th.horario, t.numero_tour FROM tourhorario th, tours t WHERE th.id_tour = t.id_tour';
    

    if ($resultado = $mysqli->query($consulta)) {

        /* obtener el array de objetos */
        while ($fila = $resultado->fetch_row()) {
            //printf ("%s (%s)\n", $fila[0], $fila[1]);							       
            if ($fila[3] < 9) {
            	$fila[3] = "0".$fila[3];
            }
            echo "<tr id='".$fila[0]." ".$fila[2]."'>\n";
            	echo "<td>".$fila[3]."</td>\n"; //numero de tour
            	echo "<td>".$fila[1]."</td>\n"; //nombre de tour
            	echo "<td>".$fila[2]."</td>\n"; //horario
            echo "<tr>\n";
        }

        /* liberar el conjunto de resultados */
        $resultado->close();
    }
    /* cerrar la conexión */
    $mysqli->close();
?>