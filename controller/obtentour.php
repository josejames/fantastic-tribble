<?php
/* Object Oriented */
// obtenusuario.php
$texto = "ERROR: ";

session_start();
 if(isset($_SESSION['logueado'])){
    if (isset($_REQUEST['id_tour'])) {

    	$id_tour = $_REQUEST['id_tour'];

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

        $consulta = "SELECT id_tour, nombre_tour FROM tours WHERE id_tour='$id_tour'";

        // Ver si la consulta ha resultado
        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            $fila = $resultado->fetch_row();

            if ($fila[0] < 9) {
	            $fila[0] = "0".$fila[0];
	        }
                //printf ("%s (%s)\n", $fila[0], $fila[1]);
                $datos['id_tour'] = $fila[0];
                $datos['nombre'] = $fila[1];
                
                header("Content-Type: application/json");
                echo json_encode($datos);
            /* liberar el conjunto de resultados */
            $resultado->close();
        }
        else{
        	echo $texto." Ocurrio un problema en la consulta";
        }
        /* cerrar la conexión */
        $mysqli->close();
    }
}
?>