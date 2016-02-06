<?php
/* Object Oriented */
// obtenhotel.php
$texto = "ERROR: ";

session_start();
 if(isset($_SESSION['logueado'])){
    if (isset($_REQUEST['id_hotel'])) {

    	$id_hotel = $_REQUEST['id_hotel'];

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

        $consulta = "SELECT * FROM institucion WHERE clave_hotel='$id_hotel'";

        // Ver si la consulta ha resultado
        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            $fila = $resultado->fetch_row();
                //printf ("%s (%s)\n", $fila[0], $fila[1]);
                $datos['nombre_hotel'] = $fila[0];
                $datos['clave'] = $fila[1];
                
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