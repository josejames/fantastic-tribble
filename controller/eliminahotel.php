<?php
/* Object Oriented */
// obtenTours.php
$texto = "ERROR: ";

    //archivo de configuracion
    include 'config.php';

    $id_hotel = $_REQUEST['id_hotel'];

    $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
    //$conn = mysql_connect($hostdb, $usuariodb, $clavedb);

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo $texto . mysqli_connect_error();
        /**printf("Falló la conexión: %s\n", mysqli_connect_error());**/
        exit();
    }

    
    //$consulta = 'select th.id_tour, t.nombre_tour, th.horario from tourhorario th, tours t WHERE th.id_tour = t.id_tour';
    $consulta = "DELETE FROM institucion WHERE clave_hotel='".$id_hotel."'";
    

    if ($resultado = $mysqli->query($consulta)) {

        /* Se elimino el registro*/
        echo "EXITO";

        /* liberar el conjunto de resultados */
        $resultado->close();
    }
    else{
        echo "Hubo un problema al remover el registro ".$mysqli->error;
    }
    /* cerrar la conexión */
    $mysqli->close();
?>