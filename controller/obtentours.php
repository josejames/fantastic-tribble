<?php
	/* Object Oriented */
	// obtenTours.php
	$texto = "ERROR: ";

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

	        $consulta = "SELECT id_tour, nombre FROM tours";

	        if ($resultado = $mysqli->query($consulta)) {

	            /* obtener el array de objetos */
	            while ($fila = $resultado->fetch_row()) {
	                //printf ("%s (%s)\n", $fila[0], $fila[1]);
	                echo "<tr id=".$fila[0].">\n";
	                	echo "<td>#</td>\n";
	                	echo "<td>".$fila[1]."</td>\n";
	                echo "<tr>\n";
	            }

	            /* liberar el conjunto de resultados */
	            $resultado->close();
	        }
	        /* cerrar la conexión */
	        $mysqli->close();
?>