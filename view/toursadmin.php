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

		<style type="text/css">
.ui-selecting { background: red; }
.ui-selected { background: #6f6; }
</style>		

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
			    <h3 class="panel-title">Tours en el Sistema</h3>
			  </div>
			  <div class="panel-body">
			    <div style="overflow-y:scroll; height:250px;">
					<table class="table table-hover " id="toursTable">
						  <thead>
							  <tr>
							    <th id="selectable" width="10%">#Tour</th>
							    <th >Nombre</th>
							    <!--<th width="15%">Horario</th>-->
							  </tr>
						  </thead>
						  <tbody id="tbodyTours">
						<?php
							/* Object Oriented */
							// obtenTours.php
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

							        $consulta = "SELECT id_tour, nombre_tour, numero_tour FROM tours ORDER BY numero_tour ASC";

							        if ($resultado = $mysqli->query($consulta)) {

							            /* obtener el array de objetos */
							            while ($fila = $resultado->fetch_row()) {
							                //printf ("%s (%s)\n", $fila[0], $fila[1]);							       
							                if ($fila[2] <= 9) {
							                	$fila[2] = "0".$fila[2];
							                }
							                echo "<tr id=".$fila[0].">\n"; //id
							                	echo "<td>".$fila[2]."</td>\n"; //numero
							                	echo "<td>".$fila[1]."</td>\n"; //nombre
							                echo "<tr>\n";
							            }

							            /* liberar el conjunto de resultados */
							            $resultado->close();
							        }
							        /* cerrar la conexión */
							        $mysqli->close();
						?>
						  
						 </tbody>
						</table>
					</div>
					<button type="button" class="btn btn-primary" onclick="eliminarTour()">Eliminar</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#complete-dialog" onclick="modificarTour()">Modificar</button>
			  </div>
			</div>

		</div>

      		<div class="col-md-8">
        		<div class="panel panel-default">
			  		<div class="panel-heading">
			    		<h3 class="panel-title">Datos del Tour</h3>
			  		</div>
			  	<div class="panel-body">
        			<form class="form-horizontal" id="formTours">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->

					    <div class="form-group">
					      <label for="inputNumero" class="col-md-2 control-label-sm">Numero</label>

					      <div class="col-md-10">
					        <input type="number" class="form-control" id="inputNumero" placeholder="Numero del tour" min="0">
					      </div>
					    </div>
					   
					    <div class="form-group">
					      <label for="inputNombre" class="col-md-2 control-label-sm">Nombre</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputNombre" placeholder="Nombre del tour">
					      </div>
					    </div>
					    
					    <!--<div class="form-group">
					      <label for="inputPassword" class="col-md-2 control-label-sm">Password</label>

					      <div class="col-md-10">
					        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
					      </div>
					    </div>-->

					    

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="saveTourData()">Guardar</button>
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
		<div id="complete-dialog" class="modal fade" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Modificar Registro</h4>
		      </div>
		      <div class="modal-body">
		        <!--Content-->
		        <form class="form-horizontal">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->
					   	<div class="form-group">
					      <label for="inputID" class="col-md-2 control-label-sm">ID</label>

					      <div class="col-md-2">
					        <input type="text" class="form-control" id="inputID" placeholder="ID del tour">
					      </div>
					    </div>

					    <div class="form-group">
					      <!--<label for="inputID" class="col-md-2 control-label-sm">ID</label>-->
					      <div class="col-md-2">
					        <input type="hidden" class="form-control" id="inputIDHIDE" placeholder="ID del tour">
					      </div>
					    </div>

					    <div class="form-group">
					      <label for="inputNombre2" class="col-md-2 control-label-sm" >Nombre</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputNombre2" placeholder="Nombre del hotel / operador">
					      </div>
					    </div>
					  	
					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="updateTour()">Guardar</button>
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




		<footer>


		</footer>

		<?php
			include '../basics/scripts.php';
		?>

		<script type="text/javascript" src="../bower_components/operadora_tours.js"></script>
		<script>
		  $.material.init();
		</script>

	</body>

</html>