<?php
/* Object Oriented */
// 
$texto = "ERROR: ";

    //archivo de configuracion
    include 'config.php';

    $datos = json_decode($_REQUEST['info'], true);
    //$id_tour = $_REQUEST['indice'];

    $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
    //$conn = mysql_connect($hostdb, $usuariodb, $clavedb);

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo $texto . mysqli_connect_error();
        /**printf("Falló la conexión: %s\n", mysqli_connect_error());**/
        exit();
    }

    
    //$consulta = 'select th.id_tour, t.nombre_tour, th.horario from tourhorario th, tours t WHERE th.id_tour = t.id_tour';
    $consulta = 'DELETE FROM tourhorario WHERE id_tour='.$datos['id_tour']." AND horario=CAST('".$datos['horario']."' as TIME)";
    

    if ($resultado = $mysqli->query($consulta)) {

        /* Se elimino el registro*/
        echo "EXITO ".$consulta;

        /* liberar el conjunto de resultados */
        //$resultado->close();
    }
    else{
        echo "Hubo un problema al remover el registro ";
    }
    /* cerrar la conexión */
    $mysqli->close();
?>