<?php
/* Object Oriented */
// GetHorarios para la forma de las reservaciones
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

        $consulta = "SELECT horario FROM tourhorario WHERE id_tour='$id_tour'";

        // Ver si la consulta ha resultado
        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            while($fila = $resultado->fetch_row()){
                echo "<option value='".$fila[0]."''>".$fila[0];
                echo "</option>\n"; 
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
}
?>