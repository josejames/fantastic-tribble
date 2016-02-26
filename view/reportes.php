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
		
			<div class="col-md-2">
			</div>

	      		<div class="col-md-8">
	        		<div class="panel panel-default">
	        			<div class="panel-heading">
				    		<h3 class="panel-title">Reportes del d&iacute;a</h3>
				  		</div>
						<form class="form-horizontal">
						  
						  <fieldset>						  
						   						   
						    <!--Select-->
						    <div class="form-group">
						      <label for="selectHorario" class="col-md-2 control-label-sm">Hora de Recorrido</label>

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


			<div class="col-md-2">

			</div>
		</div>
		<div class="row">
		
			<div class="col-md-2">
			</div>

	      		<div class="col-md-8">
	        		<div class="panel panel-default">
	        			<div class="panel-heading">
				    		<h3 class="panel-title">Reporte Recolecci&oacute;n por Hotel/Operador</h3>
				  		</div>
						<form class="form-horizontal">
						  
						  <fieldset>

						    <!--<legend class="modal-title">SELECCION DE REPORTES</legend>-->

						   
						    <div class="form-group">
						      <label for="selectHotel" class="col-md-2 control-label-sm">Hotel/Operador</label>

						      <div class="col-md-8">
						        <!--<input type="text" class="form-control" id="inputOrganizacion" placeholder="Hotel/Operador">-->
						        <select id="selectHotel" class="form-control">
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
								        $consulta = "SELECT clave_hotel, nombre_hotel FROM institucion";
								        

								        if ($resultado = $mysqli->query($consulta)) {

								            /* obtener el array de objetos */
								            while ($fila = $resultado->fetch_row()) {
								            	echo '<option value="'.$fila[0].'">'.$fila[1]."     ".'</option>';
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
						            <input type="checkbox"> Todos los Hoteles/Operadores
						          </label>						          
						        </div>
						      </div>
						    </div>

						    <div class="form-group">
						      <div class="col-md-10 col-md-offset-2">
						        <button type="button" class="btn btn-primary" onclick="generarReporteHoteles()">Generar</button>						       
						      </div>
						    </div>

						  </fieldset>
						</form>
					</div>
				</div>


			<div class="col-md-2">

			</div>
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