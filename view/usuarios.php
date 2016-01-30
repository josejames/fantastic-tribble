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
	        			<table class="table table-striped table-hover ">
						  <thead>
							  <tr>
							    <th width="5%">#</th>
							    <th>Nombre</th>
							    <th>Grado</th>
							  </tr>
						  </thead>
						  <tbody>
						  <tr>
						    <td>01</td>
						    <td>Admin</td>
						    <td>Administrador</td>
						    
						  </tr>
						  <tr>
						    <td>02</td>
						    <td>Usuario 1</td>
						    <td>Usuario normal</td>
						    
						  </tr>
						  <tr class="active">
						    <td>03</td>
						    <td>Column content</td>
						    <td>Column content</td>
						    
						  </tr>
						  <tr>
						    <td>04</td>
						    <td>Column content</td>
						    <td>Column content</td>
						    
						  </tr>
						 </tbody>
						</table>
					</div>
					<button type="button" class="btn btn-primary">Eliminar</button>
					<button type="button" class="btn btn-primary">Modificar</button>
			  </div>
			</div>

		</div>

      		<div class="col-md-8">
        		<div class="panel panel-default">
			  		<div class="panel-heading">
			    		<h3 class="panel-title">Datos de usuario</h3>
			  		</div>
			  	<div class="panel-body">
        			<form class="form-horizontal">
					  
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
					            <input type="checkbox"> Administrador
					          </label>
					        </div>
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
					        <button type="button" class="btn btn-primary" onclick="guardarUsuario()">Guardar</button>
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


		<script>
		  $.material.init();
		</script>

	</body>

</html>