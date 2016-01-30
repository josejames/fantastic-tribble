<?php
// agregausuario.php
 $texto="ERROR:";
 session_start();
 
 if(isset($_SESSION['logueado']) && $_SESSION['grado'] == 1 ){
    
    if (isset($_REQUEST['infousuario'])) {
	   $datos = json_decode($_REQUEST['infousuario'],true);
	   include 'config.php';
       $conn = mysql_connect($hostdb, $usuariodb, $clavedb);
	   if (!$conn) {
	       echo $texto.mysql_error(); 
	   }
	   else {
	       mysql_query ("SET NAMES 'utf8'");
		   if (!mysql_select_db($nombredb)) {
			  echo $texto.mysql_error(); 
		   }
		   else {
		       $sql="INSERT INTO Usuario VALUES('".$datos['rfc']."',";
               $sql .= "'".$datos['nombre']."',";
			   $sql .= "'".$datos['appaterno']."',";
			   $sql .= "'".$datos['apmaterno']."',";
			   $sql .= "'".$datos['telefono']."',";
			   $sql .= "'".$datos['calle']."',";
			   $sql .= "'".$datos['colonia']."',";
			   $sql .= $datos['idmunicipio'].",";
			   $sql .= $datos['idestado'].",";
			   $sql .= $datos['codpostal'].")";
			   			  
		       $result = mysql_query($sql);
				if ($result) {
					echo  "EXITO";
				}
				else {
					echo $texto.mysql_error(); 
				}
		   }
	   }
    } 
    else {
	   echo $texto." Hacen falta los datos";
	}
 } 
 
 ?>