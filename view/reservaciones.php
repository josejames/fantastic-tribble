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
        		<div class="well bs-component">
					<form class="form-horizontal">
					  
					  <fieldset>

					    <!--<legend class="modal-title">Ingresa aqu&iacute; tus Reservaciones</legend>-->
					   
					    <div class="form-group">
					      <label for="inputOrganizacion" class="col-md-2 control-label-sm">Hotel/Operador</label>

					      <div class="col-md-10">
					        <input type="text" class="form-control" id="inputOrganizacion" placeholder="Hotel/Operador">
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
					        <input type="text" class="form-control" id="inputProcedencia" placeholder="Procedencia">
					      </div>
					    </div>

					    <!--Select-->
					    <div class="form-group">
					      <label for="selectRecorrido" class="col-md-2 control-label-sm">Recorrido</label>

					      <div class="col-md-8">
					        <select id="selectRecorrido" class="form-control">
					          <option>1 Zacatecas Impresionante</option>
					          <option>2</option>
					          <option>3</option>
					          <option>4</option>
					          <option>5</option>
					        </select>
					      </div>

					      <div class="col-md-2">
					      	<select id="selectHorario" class="form-control">
					          <option>10:00 am</option>
					          <option>2</option>
					          <option>3</option>
					          <option>4</option>
					          <option>5</option>
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
					        <input type="number" class="form-control" id="input1" placeholder="Adultos" min="0">
					      </div>
					      <div class="col-md-2">
					        <input type="number" class="form-control" id="input1" placeholder="Ni&ntilde;os" min="0">
					      </div>
					      <div class="col-md-2">
					        <input type="number" class="form-control" id="input1" placeholder="INSEN" min="0">
					      </div>
					    </div>

					    <div class="form-group">
					      <div class="col-md-10 col-md-offset-2">
					        <button type="submit" class="btn btn-primary">Guardar</button>
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

	</body>

</html>