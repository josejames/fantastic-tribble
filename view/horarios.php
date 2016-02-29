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
			    <h3 class="panel-title">Horarios de Tours en el Sistema</h3>
			  </div>
			  <div class="panel-body">
			    <div style="overflow-y:scroll; height:250px;">
					<table class="table table-hover " id="horariosTable">
						  <thead>
							  <tr>
							    <th id="selectable" width="10%">#Tour</th>
							    <th >Nombre</th>
							    <th width="15%">Horario</th>
							  </tr>
						  </thead>
						  <tbody id="tbodyHorarios">
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

							        //$consulta = "SELECT id_tour, nombre_tour, horario FROM tourhorario, tours WHERE tours.id_tour = tourhorario.id_tour GROUP BY id_tour";
							        $consulta = 'select th.id_tour, t.nombre_tour, th.horario, t.numero_tour from tourhorario th, tours t WHERE th.id_tour = t.id_tour';
							        

							        if ($resultado = $mysqli->query($consulta)) {

							            /* obtener el array de objetos */
							            while ($fila = $resultado->fetch_row()) {
							                //printf ("%s (%s)\n", $fila[0], $fila[1]);							       
							                if ($fila[3] <= 9) {
							                	$fila[3] = "0".$fila[3];
							                }
							                echo "<tr id='".$fila[0]." ".$fila[2]."'>\n"; //id
							                	echo "<td>".$fila[3]."</td>\n"; //numero
							                	echo "<td>".$fila[1]."</td>\n"; //nombre del tour
							                	echo "<td>".$fila[2]."</td>\n"; //horario del tour
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
					<button type="button" class="btn btn-primary" onclick="eliminarHorario()">Eliminar</button>
					<!--<button type="button" class="btn btn-primary" onclick="modificarTour()">Modificar</button>-->
			  </div>
			</div>

		</div>

      		<div class="col-md-8">
        		<div class="panel panel-default">
			  		<div class="panel-heading">
			    		<h3 class="panel-title">Datos del Tour</h3>
			  		</div>
			  	<div class="panel-body">
        			<form class="form-horizontal" id="formHorariosTour">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->
					   
					    <div class="form-group">
					      <label for="inputNombre" class="col-md-2 control-label-sm">TOUR</label>

					      <div class="col-md-10">
					        <select class="form-control" id="selectTour" placeholder="Selecciona Tour">
					        	<!-- Fill the options -->
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

							      
							        $consulta = 'SELECT id_tour, nombre_tour, numero_tour FROM tours';
							        

							        if ($resultado = $mysqli->query($consulta)) {

							            /* obtener el array de objetos */
							            while ($fila = $resultado->fetch_row()) {
							                //printf ("%s (%s)\n", $fila[0], $fila[1]);							       
							                if ($fila[2] <= 9) {
							                	$fila[2] = "0".$fila[2];
							                }
							                echo "<option id=".$fila[0]." value=".$fila[0].">\n"; //id and value
							                	echo "".$fila[2]." ".$fila[1]."\n"; //numero y nombre
											echo "</option>\n";
							            }

							            /* liberar el conjunto de resultados */
							            $resultado->close();
							        }
							        /* cerrar la conexión */
							        $mysqli->close();
						?>
					        	<!-- End Fill the options -->
					        </select>
					      </div>
					    </div>
					    
					    <div class="form-group">
					      <label for="inputTime" class="col-md-2 control-label-sm">Time</label>

					      <div class="col-md-10">
					        <input type="time" class="form-control" id="inputTime" placeholder="Time">
					      </div>
					    </div>

					    

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="saveHorarioData()">Guardar</button>
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
		

		<footer>


		</footer>

		<?php
			include '../basics/scripts.php';
		?>

		<script type="text/javascript" src="../bower_components/operadora_horario.js"></script>
		<script>
		  $.material.init();
		</script>

	</body>

</html>