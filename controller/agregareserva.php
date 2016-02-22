<?php
// agregareserva.php
 $texto="ERROR:";
 session_start();
 
 if(isset($_SESSION['logueado'])){
    
    if (isset($_REQUEST['info'])) {
	   
	   $datos = json_decode($_REQUEST['info'], true);
	   
	   include 'config.php';
	  
       $conn = mysqli_connect($hostdb, $usuariodb, $clavedb, $nombredb);
	   
	   /* comprobar la conexión */
	   if (!$conn) {
	       echo $texto.mysqli_connect_errno();
	   }
	   if (mysqli_connect_errno()) {
    		echo $texto.mysqli_connect_errno();
	   }
	   else {
	   		/*Se conecto bien a mysql*/
	        mysqli_query ($conn, "SET NAMES 'utf8'");
	       //select the database
		   if ( !mysqli_select_db($conn, $nombredb) ) {
			  echo $texto." No se pudo seleccionar la base de datos";
		   }
		   else {
		   		
		       $sql="INSERT INTO reserva (cuenta_usuario, id_cliente, procedencia, id_tour, horario, clave_institucion, fecha, num_adultos, num_ninos, num_insen, habitacion) VALUES('".$_SESSION['usuario']."',";
		       $sql .= "'".$datos['cliente']."',";
		       $sql .= "'".$datos['procedencia']."',";
		   	   $sql .= "'".$datos['id_tour']."',";
		   	   $sql .= "'".$datos['horario']."',";
		   	   $sql .= "'".$datos['id_hotel']."',";
		   	   $sql .= "'".$datos['fecha']."',";
		   	   $sql .= "'".$datos['adultos']."',";
		   	   $sql .= "'".$datos['ninios']."',";
		   	   $sql .= "'".$datos['insen']."',";
               $sql .= "".$datos['habitacion'].")";
			   			  
		       $result = mysqli_query($conn, $sql);
				if ($result) {
					echo  "EXITO";
				}
				else {
					echo $texto." No se pudo insertar";
				}
		   }
	   }//else se conecto
    }// if request info 
    else {
	   echo $texto." Hacen falta los datos";
	}
 } 
 
 ?>