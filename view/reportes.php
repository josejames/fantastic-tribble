<?php
	//verificamos la sesion
	session_start();
 	if( !isset($_SESSION['logueado']) ){
 		header("Location: ../login.php");
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

		<div class="row">
		
			<!--<div class="col-md-1">
			</div>-->
				<!-- Div Reportes del dia por Tours -->
	      		<div class="col-md-6">
	        		<div class="panel panel-default">
	        			<div class="panel-heading">
				    		<h3 class="panel-title">Reportes del d&iacute;a por Tours</h3>
				  		</div>
						<form class="form-horizontal">
						  
						  <fieldset>						  
						   						   
						    <!--Select-->
						    <div class="form-group">
						      <label for="selectHorario" class="col-md-2 control-label-sm">Hora Recorrido</label>

						      <div class="col-md-8">
						        <select id="selectHorario" class="form-control">
						        	<option value="-1">Selecciona Hora</option>
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

								        $consulta = "SELECT id_tour, horario FROM tourhorario GROUP BY horario";

								        if ($resultado = $mysqli->query($consulta)) {

								            /* obtener el array de objetos */
								            while ($fila = $resultado->fetch_row()) {
								        
								                echo "<option value=".$fila[1].">";								                	
								                	echo " ".$fila[1]."";
								                echo "</option>\n";
								            }

								            /* liberar el conjunto de resultados */
								            $resultado->close();
								        }
								        /* cerrar la conexión */
								        $mysqli->close();
								?>
						        </select>
						      </div>						      

						    </div>
						    <!--Select end -->
						    <div class="form-group" style="margin-top: 0;"> <!-- inline style is just to demo custom css to put checkbox below input above -->
						      <div class="col-md-offset-2 col-md-10">
						        <div class="checkbox">
						          <label>
						            <input type="checkbox" id="checkTour"> Todos los Tours
						          </label>						          
						        </div>
						      </div>
						    </div>

						   
						    						   
						    <div class="form-group">
						      <div class="col-md-10 col-md-offset-2">
						        <button type="button" class="btn btn-primary" onclick="generarReportes()">Generar</button>						     
						      </div>
						    </div>

						  </fieldset>
						</form>
					</div>

				</div>

				<div class="col-md-6">
	        		<div class="panel panel-default">
	        			<div class="panel-heading">
				    		<h3 class="panel-title">Reportes de Tour &Uacute;nico</h3>
				  		</div>
						<form class="form-horizontal">
						  
						  <fieldset>						  
						   						   
						    <!--Select-->
						    <div class="form-group">
						      <label for="selectTour" class="col-md-2 control-label-sm">Tour</label>

						      <div class="col-md-8">
						        <select id="selectTour" class="form-control">
						        	<option value="-1">Selecciona un Tour</option>
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

								        //$consulta = "SELECT id_tour, horario FROM tourhorario GROUP BY horario";
								        //$consulta = "SELECT id_tour, nombre_tour, numero_tour FROM tours ORDER BY numero_tour ASC";
								        $consulta = 'SELECT th.id_tour, t.nombre_tour, th.horario, t.numero_tour FROM tourhorario th, tours t WHERE th.id_tour = t.id_tour';

								        if ($resultado = $mysqli->query($consulta)) {

								            /* obtener el array de objetos */
								            while ($fila = $resultado->fetch_row()) {
								        		
								        		if ($fila[3] <= 9) {
							                		$fila[3] = "0".$fila[3];
							                	}

								                echo "<option value='".$fila[0]." ".$fila[2]."'>";								                	
								                	echo " ".$fila[3]." ".$fila[1]." ".$fila[2];
								                echo "</option>\n";
								            }

								            /* liberar el conjunto de resultados */
								            $resultado->close();
								        }
								        /* cerrar la conexión */
								        $mysqli->close();
								?>
						        </select>
						      </div>						      

						    </div>
						    <!--Select end -->
						    <div class="form-group" style="margin-top: 0;"> <!-- inline style is just to demo custom css to put checkbox below input above -->
						      <div class="col-md-offset-2 col-md-10">
						        <div class="checkbox">
						          <label>
						            <!--<input type="checkbox" id="checkTour"> Todos los Tours-->
						          </label>						          
						        </div>
						      </div>
						    </div>

						   
						    						   
						    <div class="form-group">
						      <div class="col-md-10 col-md-offset-2">
						        <button type="button" class="btn btn-primary" onclick="generarReporteUnTour()">Generar</button>						     
						      </div>
						    </div>

						  </fieldset>
						</form>
					</div>

				</div>



			<!--<div class="col-md-1">

			</div>-->
		</div>
		<div class="row">
		
			<!--<div class="col-md-1">
			</div>-->

	      		<div class="col-md-6">
	        		<div class="panel panel-default">
	        			<div class="panel-heading">
				    		<h3 class="panel-title">Reporte de Recolecci&oacute;n Hotel/Operador</h3>
				  		</div>
						<form class="form-horizontal">
						  
						  <fieldset>

						    <!--<legend class="modal-title">SELECCION DE REPORTES</legend>-->

						   
						    <div class="form-group">
						      <label for="selectHotel" class="col-md-2 control-label-sm">Hora de Recorrido</label>

						    	<div class="col-md-8">
						        	<!--<input type="text" class="form-control" id="inputOrganizacion" placeholder="Hotel/Operador">-->
						      	  <select id="selectHotelHora" class="form-control">
						        	<option value="-1">Selecciona Hora</option>
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

								        $consulta = "SELECT id_tour, horario FROM tourhorario GROUP BY horario";

								        if ($resultado = $mysqli->query($consulta)) {

								            /* obtener el array de objetos */
								            while ($fila = $resultado->fetch_row()) {
								        
								                echo "<option value=".$fila[1].">";								                	
								                	echo " ".$fila[1]."";
								                echo "</option>\n";
								            }

								            /* liberar el conjunto de resultados */
								            $resultado->close();
								        }
								        /* cerrar la conexión */
								        $mysqli->close();
									?>
						        	
						       	 </select>
						     	 </div>
						    </div>

						    <div class="form-group" style="margin-top: 0;"> <!-- inline style is just to demo custom css to put checkbox below input above -->
						      <div class="col-md-offset-2 col-md-10">
						        <div class="checkbox">
						          <label>
						            <input type="checkbox" id="checkHora"> Todos las Horas
						          </label>						          
						        </div>
						      </div>
						    </div>

						    <div class="form-group">
						      <div class="col-md-10 col-md-offset-2">
						        <button type="button" class="btn btn-primary" onclick="generarReportesH()">Generar</button>						       
						      </div>
						    </div>

						  </fieldset>
						</form>
					</div>
				</div>

				<div class="col-md-6">
	        		<div class="panel panel-default">
	        			<div class="panel-heading">
				    		<h3 class="panel-title">Recolecci&oacute;n Hotel/Operador &Uacute;nico</h3>
				  		</div>
						<form class="form-horizontal">
						  
						  <fieldset>

						    <!--<legend class="modal-title">SELECCION DE REPORTES</legend>-->

						   
						    <div class="form-group">
						      <label for="selectHotelUnico" class="col-md-2 control-label-sm">Hotel</label>

						    	<div class="col-md-8">
						        	<!--<input type="text" class="form-control" id="inputOrganizacion" placeholder="Hotel/Operador">-->
						      	  <select id="selectHotelUnico" class="form-control">
						        	<option value="-1">Selecciona Hotel</option>
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

								        //$consulta = "SELECT id_tour, horario FROM tourhorario GROUP BY horario";
								        $consulta = "SELECT clave_hotel, nombre_hotel FROM institucion";

								        if ($resultado = $mysqli->query($consulta)) {

								            /* obtener el array de objetos */
								            while ($fila = $resultado->fetch_row()) {
								        
								                echo "<option value=".$fila[0].">";								                	
								                	echo " ".$fila[0]." - ".$fila[1]."";
								                echo "</option>\n";
								            }

								            /* liberar el conjunto de resultados */
								            $resultado->close();
								        }
								        /* cerrar la conexión */
								        $mysqli->close();
									?>
						        	
						       	 </select>
						     	 </div>
						    </div>

						    <div class="form-group" style="margin-top: 0;"> <!-- inline style is just to demo custom css to put checkbox below input above -->
						      <div class="col-md-offset-2 col-md-10">
						        <div class="checkbox">
						          <label>
						            <!--<input type="checkbox" id="checkHora"> Todos las Horas-->
						          </label>						          
						        </div>
						      </div>
						    </div>

						    <div class="form-group">
						      <div class="col-md-10 col-md-offset-2">
						        <button type="button" class="btn btn-primary" onclick="generarReporteHotelUnico()">Generar</button>						       
						      </div>
						    </div>

						  </fieldset>
						</form>
					</div>
				</div>


			<!--<div class="col-md-1">

			</div>-->
		</div>
		
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


		<script>
		  $.material.init();
		</script>
		<script type="text/javascript" src="../bower_components/reportes.js"></script>


	</body>

</html>