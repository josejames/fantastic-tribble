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
					<form class="form-horizontal">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->
					   
					    <div class="form-group">
					      <label for="selectHotel" class="col-md-2 control-label-sm">Hotel/Operador</label>

					      <div class="col-md-10">
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
							        $consulta = "SELECT clave_hotel FROM institucion";
							        

							        if ($resultado = $mysqli->query($consulta)) {

							            /* obtener el array de objetos */
							            while ($fila = $resultado->fetch_row()) {
							            	echo '<option value="'.$fila[0].'">'.$fila[0]."     ".'</option>';
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
					  	<div class="form-group">
					      <label for="inputHabitacion" class="col-md-2 control-label-sm">Habitaci&oacute;n</label>

					      <div class="col-md-2">
					        <input type="number" class="form-control" id="inputHabitacion" placeholder="Habitaci&oacute;n" min="0">
					      </div>
					    </div>

					    <div class="form-group">
					      <label for="inputProcendencia" class="col-md-2 control-label-sm">Procedencia</label>

					      <div class="col-md-10">
					        <!--<input type="text" class="form-control" id="inputProcedencia" placeholder="Procedencia">-->
					        <select id="selectProcedencia" class="form-control">
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
							        $consulta = "SELECT id_nacion, nombre FROM country";
							        

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

					    <!--Select-->
					    <div class="form-group">
					      <label for="selectRecorrido" class="col-md-2 control-label-sm">Recorrido</label>

					      <div class="col-md-8">
					        <select id="selectRecorrido" class="form-control" onchange="cargaHorarios()">
					        	<option value="-1">Selecciona Tour</option>
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

							        $consulta = "SELECT id_tour, nombre_tour FROM tours";

							        if ($resultado = $mysqli->query($consulta)) {

							            /* obtener el array de objetos */
							            while ($fila = $resultado->fetch_row()) {
							        
							                echo "<option value=".$fila[0].">\n";
							                	echo "". ($fila[0] <= 9 ? "0".$fila[0] : $fila[0]) ."";
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

					      <div class="col-md-2">
					      	<select id="selectHorario" class="form-control">
					        </select>
					      </div>

					    </div>
					    <!--Select end -->

					    <div class="form-group">
					      <label for="inputFecha" class="col-md-2 control-label-sm">Fecha</label>

					      <div class="col-md-2">
					        <input type="text" class="form-control" id="inputFecha" >
					      </div>
					    </div>

					    <div class="form-group">
					      <label for="inputPersonas" class="col-md-2 control-label-sm">Personas</label>

					      <div class="col-md-2">
					        <input type="number" class="form-control" id="inputAd" placeholder="Adultos" min="0">
					      </div>
					      <div class="col-md-2">
					        <input type="number" class="form-control" id="inputNi" placeholder="Ni&ntilde;os" min="0">
					      </div>
					      <div class="col-md-2">
					        <input type="number" class="form-control" id="inputIn" placeholder="INSEN" min="0">
					      </div>
					    </div>

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="saveReservacion()">Guardar</button>
					        <button type="button" class="btn btn-default">Nuevo</button>
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


		<script>
		  $.material.init();
		</script>
		<script type="text/javascript" src="../bower_components/reservaciones.js"></script>
		<script type="text/javascript">
		$(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#inputOrganizacion" ).autocomplete({
      source: availableTags
    });
  });
  </script>


	</body>

</html>