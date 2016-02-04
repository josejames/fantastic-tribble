<?php
// obtenhoteles.php
/*$texto = "ERROR: ";
session_start();

if (isset($_SESSION['logueado'])) {
    $id = "";
    
        $id = $_REQUEST['id_pelicula'];

        //archivo de configuracion
        include 'config.php';

        $conn = mysql_connect($hostdb, $usuariodb, $clavedb);
        if (!$conn) {
            //Error  de conexion
            echo $texto . mysql_error();
        } else {
            
            mysql_query("SET NAMES 'utf8'");

            if (!mysql_select_db($nombredb)) {
                //Error no existe la base de datos
                echo $texto . mysql_error();
            } else {
                //Hacer el Query
                $result = mysql_query("SELECT * FROM institucion WHERE id_istitucion ='$id'");
                
                if ($result) {
                    $registro = mysql_fetch_row($result);
                    $datos['id_pelicula'] = $registro[0];
                    $datos['titulo'] = $registro[1];
                    $datos['fecha_estreno'] = $registro[2];
                    $datos['fecha_compra'] = $registro[3];
                    $datos['duracion'] = $registro[4];
                    $datos['urlpelicula'] = $registro[5];
                    $datos['urlimagen'] = $registro[6];
                    header("Content-Type: application/json");
                    echo json_encode($datos);
                } else {
                    //hubo un error al obtener la consulta
                    echo $texto . mysql_error();
                }
            }
        }

}*/
?>


<?php
/* Object Oriented */
// obtenhoteles.php
$texto = "ERROR: ";
session_start();

if (isset($_SESSION['logueado'])) {
    $id = "";
    
        $id = $_REQUEST['id_hotel'];

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

        $consulta = "SELECT * FROM institucion WHERE id_istitucion ='$id'";

        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                //printf ("%s (%s)\n", $fila[0], $fila[1]);
                echo "Result = ".$fila[1]." ".$fila[2];
            }

            /* liberar el conjunto de resultados */
            $resultado->close();
        }

        /* cerrar la conexión */
        $mysqli->close();
}

?>