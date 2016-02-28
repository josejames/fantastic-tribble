<?php
/* Object Oriented */
// eliminaUsuario.php
$texto = "ERROR: ";

    //archivo de configuracion
    include 'config.php';

    $id_usuario = $_REQUEST['id_usuario'];

    $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
    //$conn = mysql_connect($hostdb, $usuariodb, $clavedb);

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo $texto . mysqli_connect_error();
        /**printf("Falló la conexión: %s\n", mysqli_connect_error());**/
        exit();
    }

    
    $consulta = "DELETE FROM usuario WHERE cuenta='".$id_usuario."'";
    

    if ($resultado = $mysqli->query($consulta)) {

        /* Se elimino el registro*/
        echo "EXITO";

        /* liberar el conjunto de resultados */
        $resultado->close();
    }
    else{
        echo "Hubo un problema al remover el registro";
    }
    /* cerrar la conexión */
    $mysqli->close();
?>