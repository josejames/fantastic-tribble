<?php
	//verificamos que exista una sesion
	session_start();
 	if( !isset($_SESSION['logueado']) ){
 		header("Location: ../login.php");
 	}
 	//verificamos que tenga los privilegios correctos
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
			    <h3 class="panel-title">Usuarios en el Sistema</h3>
			  </div>
			  <div class="panel-body">
			    <div style="overflow-y:scroll; height:250px;">
	        			<table class="table table-striped table-hover " id="usuarioTable">
						  <thead>
							  <tr>
							    <th width="5%">#</th>
							    <th>Nombre</th>
							    <th>Cuenta</th>
							    <th>Grado</th>
							  </tr>
						  </thead>
						  <tbody id="tbodyUsuario">
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

							        $consulta = "SELECT cuenta, nombre, grado FROM usuario";

							        if ($resultado = $mysqli->query($consulta)) {

							            /* obtener el array de objetos */
							            while ($fila = $resultado->fetch_row()) {
							                //printf ("%s (%s)\n", $fila[0], $fila[1]);
							                echo "<tr id=".$fila[0].">\n";
							                	echo "<td>#</td>\n";
							                	echo "<td>".$fila[1]."</td>\n";
							                	echo "<td>".$fila[0]."</td>\n";
							                	if ( $fila[2] == "1") {
							                		echo "<td> Administrador </td>\n";
							                	}else{
							                		echo "<td> Normal </td>\n";
							                	}
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
						 </tbody>
						</table>
					</div>
					<button type="button" class="btn btn-primary" onclick="eliminarUsuario()">Eliminar</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#complete-dialog" onclick="modificarUsuario()">Modificar</button>
			  </div>
			</div>

		</div>

      		<div class="col-md-8">
        		<div class="panel panel-default">
			  		<div class="panel-heading">
			    		<h3 class="panel-title">Datos de usuario</h3>
			  		</div>
			  	<div class="panel-body">
        			<form class="form-horizontal" action="#" id="formUsuario">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->
					   
					    <div class="form-group">
					      <label for="inputNombre" class="col-md-2 control-label-sm">Nombre</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputNombre" placeholder="Nombre">
					      </div>
					    </div>
					  	<div class="form-group">
					      <label for="inputAp" class="col-md-2 control-label-sm">Primer Apellido</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputAp" placeholder="Primer Apellido" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label for="inputAm" class="col-md-2 control-label-sm">Segundo Apellido</label>

					       <div class="col-md-10">
					        <input type="text" class="form-control" id="inputAm" placeholder="Segundo Apellido" >
					       </div>
					    </div>

					    <div class="form-group">
					      <div class="col-md-offset-2 col-md-10">
					        <div class="togglebutton">
					          <label>
					            <input id="inputAdmin" type="checkbox"> Administrador
					          </label>
					        </div>
					      </div>
					    </div>

					    <div class="form-group">
					      <label for="inputCuenta" class="col-md-2 control-label-sm">Cuenta</label>

					       <div class="col-md-10">
					       	 <input type="text" class="form-control" id="inputCuenta" placeholder="Cuenta de Usuario" >
					       </div>
					    </div>


					    <div class="form-group">
					      <label for="inputPassword" class="col-md-2 control-label-sm">Password</label>

					       <div class="col-md-10">
					       	 <input type="password" class="form-control" id="inputPassword" placeholder="Password" >
					       </div>
					    </div>

					    <!--<div class="form-group">
					      <label for="inputPassword2" class="col-md-2 control-label-sm">Password</label>

					      <div class="col-md-10">
					        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
					      </div>
					    </div>-->

					    

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="saveUsuarioData()">Guardar</button>
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
		        <form class="form-horizontal">
					  
					  <fieldset>

					  	<div class="form-group">
					      <label for="inputCuenta2" class="col-md-2 control-label-sm">Cuenta</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputCuenta2" placeholder="Cuenta" readonly="true">
					      </div>
					    </div>

					    <div class="form-group">
					      <label for="inputNombre2" class="col-md-2 control-label-sm">Nombre</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputNombre2" placeholder="Nombre">
					      </div>
					    </div>
					  	<div class="form-group">
					      <label for="inputAp2" class="col-md-2 control-label-sm">Primer Apellido</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputAp2" placeholder="Primer Apellido" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label for="inputAm2" class="col-md-2 control-label-sm">Segundo Apellido</label>

					       <div class="col-md-10">
					        <input type="text" class="form-control" id="inputAm2" placeholder="Segundo Apellido" >
					       </div>
					    </div>

					    <div class="form-group">
					      <div class="col-md-offset-2 col-md-10">
					        <div class="togglebutton">
					          <label>
					            <input id="inputAdmin2" type="checkbox"> Administrador
					          </label>
					        </div>
					      </div>
					    </div>

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="button" class="btn btn-primary" onclick="updateUsuario()">Guardar</button>
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


		</footer>

		<?php
			include '../basics/scripts.php';

		?>

		<script type="text/javascript" src="../bower_components/operadora_usuario.js"></script>
		<script>
		  $.material.init();
		</script>

	</body>

</html>