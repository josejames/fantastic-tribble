<?php
// obtenhoteles.php
$texto = "ERROR:";
session_start();
if (isset($_SESSION['logueado'])) {
    $id = "";
    
        $id = $_REQUEST['id_pelicula'];
        include 'config.php';
        $conn = mysql_connect($hostdb, $usuariodb, $clavedb);
        if (!$conn) {
            echo $texto . mysql_error();
        } else {
            mysql_query("SET NAMES 'utf8'");
            if (!mysql_select_db($nombredb)) {
                echo $texto . mysql_error();
            } else {
                $result = mysql_query("SELECT * FROM Pelicula WHERE id_pelicula='$id'");
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
                    echo $texto . mysql_error();
                }
            }
        }

}
?>