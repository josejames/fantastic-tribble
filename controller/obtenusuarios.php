<?php
/* Object Oriented */
// obtenusuario.php
$texto = "ERROR: ";

session_start();
 if(isset($_SESSION['logueado'])){

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

        $consulta = "SELECT cuenta, nombre, grado FROM usuario";

        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                //printf ("%s (%s)\n", $fila[0], $fila[1]);
                echo "<tr id=".$fila[0].">\n";
                    echo "<td>#</td>\n";
                    echo "<td>".$fila[1]."</td>\n";
                    echo "<td>".$fila[0]."</td>\n";
                    if ( $fila[2] == "1") {
                        echo "<td> Administrador </td>\n";
                    }else{
                        echo "<td> Normal </td>\n";
                    }
                echo "<tr>\n";
            }

            /* liberar el conjunto de resultados */
            $resultado->close();
        }
        else{
        	echo $texto." Ocurrio un problema en la consulta";
        }
        /* cerrar la conexión */
        $mysqli->close();
}
?>