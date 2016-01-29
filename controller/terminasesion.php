<?php 
 session_start();
 
 if(isset($_SESSION['logueado'])){
 	//destruimos la sesion
	session_unset();
	session_destroy();
	header("Location: ../login.php");
 }

 ?>

