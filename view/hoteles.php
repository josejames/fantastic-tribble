<?php
	//verificamos la sesion
	session_start();
 	if( !isset($_SESSION['logueado']) ){
 		header("Location: ../login.php");
 	}
 	if($_SESSION['grado'] != 1){
 		header("Location: ../view/error.php");	
 	}

?>
<!DOCTYPE html>
<html>

	<head>
		<title>Operadora</title>

		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">

  		<!-- Mobile support -->
  		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php
			include '../basics/estilos.php';
		?>

		

	</head>


	<body>

		<!--
		Navegacion
		-->
		<nav>
			<?php
				include '../basics/menubar.php';
			?>
		</nav>


		</nav>

		<!--
		End Navegacion
		-->


		<!--
		Contenido
		-->
		<!--
		Form
		-->

		<div class="row" >
		
		<div class="col-md-4">

			
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Hoteles en el Sistema</h3>
			  </div>
			  <div class="panel-body">
			    <div style="overflow-y:scroll; height:250px;">
	        			<table class="table table-hover " id="resultTable">
						  <thead>
							  <tr>
							    <th width="5%">#</th>
							    <th>Nombre</th>
							    <th width="10%">Clave</th>
							  </tr>
						  </thead>
						  <tbody id="tbodyHotel">
						  <!-- generated table -->

						<?php
							/* Object Oriented */
							// obtenhoteles.php
							$texto = "ERROR: ";
						
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
							?>

						  <!-- generated table -->


						 </tbody>
						</table>
					</div>
					<button type="button" class="btn btn-primary" onclick="eliminarHotel()">Eliminar</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#complete-dialog" onclick="modificarHotel()">Modificar</button>
			  </div>
			</div>

		</div>

      		<div class="col-md-8">
        		<div class="panel panel-default">
			  		<div class="panel-heading">
			    		<h3 class="panel-title">Datos de Hotel / Operador</h3>
			  		</div>
			  	<div class="panel-body">
        			<form class="form-horizontal" id="formHotel">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->
					   
					    <div class="form-group">
					      <label for="inputNombre" class="col-md-2 control-label-sm">Nombre</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputNombre" placeholder="Nombre del hotel / operador">
					      </div>
					    </div>
					  	<div class="form-group">
					      <label for="inputClave" class="col-md-2 control-label-sm">Clave</label>

					      <div class="col-md-2">
					        <input type="text" class="form-control" id="inputClave" placeholder="Clave" maxlength="2" style="text-transform: uppercase;">
					        <!--<span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>-->
					      </div>

					    </div>					    					  

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="savetHotelData()">Guardar</button>
					        <!--<button type="button" class="btn btn-default">Nuevo</button>-->
					      </div>
					    </div>

					  </fieldset>
					</form>
					
				</div>
			</div>


		<div class="col-md-2">


		</div>
		<div class="row">
		
		<!--
		Form
		-->
		<!--
		End Contenido
		-->

		<!-- Dialog -->
		<div id="complete-dialog" class="modal fade" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Modificar Registro</h4>
		      </div>
		      <div class="modal-body">
		        <!--Content-->
		        <form class="form-horizontal" action="#">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->
					   
					    <div class="form-group">
					      <label for="inputNombre2" class="col-md-2 control-label-sm" >Nombre</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputNombre2" placeholder="Nombre del hotel / operador">
					      </div>
					    </div>
					  	<div class="form-group">
					      <label for="inputClave2" class="col-md-2 control-label-sm">Clave</label>

					      <div class="col-md-2">
					        <input type="text" class="form-control" id="inputClave2" readonly="true" placeholder="Clave" maxlength="2" style="text-transform: uppercase;">
					        <!--<span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>-->
					      </div>

					    </div>

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="updateHotel()">Guardar</button>
					        <!--<button type="button" class="btn btn-default">Nuevo</button>-->
					      </div>
					    </div>

					  </fieldset>
					</form>

		        <!--Content-->
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>


		<!-- End Dialog -->


		<footer>

			<!--<table id="resultTable" class="table table-striped table-hover ">
				 <tr id="first">
				  <td>c1</td>      
				  <td>c2</td>      
				 </tr>
				 <tr id="second">
				  <td>c3</td>      
				  <td>c4</td>      
				  </tr>    
				</table>-->



		</footer>

		<?php
			include '../basics/scripts.php';
		?>


		<script>
		  $.material.init();
		  //loadHoteles();
		</script>

	</body>

</html>