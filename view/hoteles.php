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
	        			<table class="table table-striped table-hover ">
						  <thead>
							  <tr>
							    <th width="5%">#</th>
							    <th>Nombre</th>
							    <th width="10%">Clave</th>
							  </tr>
						  </thead>
						  <tbody>
						  <tr>
						    <td>01</td>
						    <td>Column content</td>
						    <td>Column content</td>
						    
						  </tr>
						  <tr>
						    <td>02</td>
						    <td>Column content</td>
						    <td>Column content</td>
						    
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
			    		<h3 class="panel-title">Datos de Hotel / Operador</h3>
			  		</div>
			  	<div class="panel-body">
        			<form class="form-horizontal">
					  
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
					        <input type="text" class="form-control" id="inputClave" placeholder="Clave" >
					      </div>
					    </div>
					    
					    <div class="form-group">
					      <label for="inputPassword" class="col-md-2 control-label-sm">Password</label>

					      <div class="col-md-10">
					        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
					      </div>
					    </div>

					    

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="submit" class="btn btn-primary">Guardar</button>
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