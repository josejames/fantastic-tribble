<?php
// obtenhoteles.php
$texto = "ERROR: ";
session_start();

if (isset($_SESSION['logueado'])) {

        /* Object Oriented */
                        
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

        $consulta = "SELECT * FROM institucion";

        if ($resultado = $mysqli->query($consulta)) {

            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                //printf ("%s (%s)\n", $fila[0], $fila[1]);
                echo "<tr id=".$fila[1].">\n";
                    echo "<td>#</td>\n";
                    echo "<td>".$fila[0]."</td>\n";
                    echo "<td>".$fila[1]."</td>\n";
                echo "<tr>\n";
            }

            /* liberar el conjunto de resultados */
            $resultado->close();
        }
        /* cerrar la conexión */
        $mysqli->close();
                             
}
?>


<?php
/* Object Oriented */
// obtenhoteles.php
// $texto = "ERROR: ";
// session_start();

// if (isset($_SESSION['logueado'])) {
//     $id = "";
    
//         $id = $_REQUEST['id_hotel'];

//         //archivo de configuracion
//         include 'config.php';

//         $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
//         //$conn = mysql_connect($hostdb, $usuariodb, $clavedb);

//         /* comprobar la conexión */
//         if (mysqli_connect_errno()) {
//             echo $texto . mysqli_connect_error();
//             /**printf("Falló la conexión: %s\n", mysqli_connect_error());**/
//             exit();
//         }

//         $consulta = "SELECT * FROM institucion WHERE id_istitucion ='$id'";

//         if ($resultado = $mysqli->query($consulta)) {

//             /* obtener el array de objetos */
//             while ($fila = $resultado->fetch_row()) {
//                 //printf ("%s (%s)\n", $fila[0], $fila[1]);
//                 echo "Result = ".$fila[1]." ".$fila[2];
//             }

//             /* liberar el conjunto de resultados */
//             $resultado->close();
//         }

//         /* cerrar la conexión */
//         $mysqli->close();
// }

?>