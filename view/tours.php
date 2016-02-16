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
		
		<div class="col-md-3">
			<div id="selectFecha" align="middle"></div>
		</div>

      		<div class="col-md-8" >
        		<div class="panel panel-default">

        			<div style="overflow-y:scroll; height:230px;">
	        			<table class="table table-striped table-hover " id="thTable">
						  <thead>
							  <tr>
							    <th width="10%"># Tour</th>
							    <th>Nombre</th>
							    <th width="20%">Hora</th>
							  </tr>
						  </thead>
						  <tbody id="tbodyth">
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
							        $consulta = 'select th.id_tour, t.nombre_tour, th.horario from tourhorario th, tours t WHERE th.id_tour = t.id_tour';
							        

							        if ($resultado = $mysqli->query($consulta)) {

							            /* obtener el array de objetos */
							            while ($fila = $resultado->fetch_row()) {
							                //printf ("%s (%s)\n", $fila[0], $fila[1]);							       
							                if ($fila[0] < 9) {
							                	$fila[0] = "0".$fila[0];
							                }
							                echo "<tr id='".$fila[0]." ".$fila[2]."'>\n";
							                	echo "<td>".$fila[0]."</td>\n";
							                	echo "<td>".$fila[1]."</td>\n";
							                	echo "<td>".$fila[2]."</td>\n";
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
					
				</div><!--end container-->
			</div><!--end column -->
		</div><!--end row-->


	
		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-10" >
        		
					<div class="progress">
		  				<div class="progress-bar progress-bar-info" style="width: 100%"></div>
					</div>
				
			</div>

			<div class="col-md-1">
			</div>
		</div>
		
	
		<!-- tercera parte -->
		<div class="row">

      		<div class="col-md-12" >
        		<div class="well bs-component">

        			<div style="overflow-y:scroll; height:250px;">
	        			<table class="table table-striped table-hover ">
						  <thead>
							  <tr>
							    <th>Nombre</th>
							    <th>Hotel</th>
							    <th width="10%">Hab</th>
							    <th width="10%">Adultos</th>
							    <th width="10%">Menores</th>
							    <th width="10%">INSEN</th>
							  </tr>
						  </thead>
						  <tbody id="tbodyLog">
						  
						  </tbody>
						</table>
					</div>
					
				</div><!--end container-->
			</div><!--end column -->
		</div><!--end row-->






		<!--
		End Contenido
		-->


		<footer>


		</footer>

		<?php
			include '../basics/scripts.php';
		?>

		<script type="text/javascript" src="../bower_components/tours_view.js"></script>
		<script>
		  $.material.init();
		</script>

	</body>

</html>