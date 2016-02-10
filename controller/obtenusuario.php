<?php
/* Object Oriented */
// obtenusuario.php
$texto = "ERROR: ";

session_start();
 if(isset($_SESSION['logueado'])){
    if (isset($_REQUEST['id_usuario'])) {

    	$id_usuario = $_REQUEST['id_usuario'];

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

        $consulta = "SELECT nombre, apellidopaterno, apellidomaterno, grado, cuenta FROM usuario WHERE cuenta='$id_usuario'";

        // Ver si la consulta ha resultado
        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            $fila = $resultado->fetch_row();
                //printf ("%s (%s)\n", $fila[0], $fila[1]);
                $datos['nombre'] = $fila[0];
                $datos['apPat'] = $fila[1];
                $datos['apMat'] = $fila[2];
                $datos['grado'] = $fila[3];
                $datos['cuenta'] = $fila[4];

                
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