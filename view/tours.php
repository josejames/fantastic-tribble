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
        		<div class="well bs-component">

        			<div style="overflow-y:scroll; height:230px;">
	        			<table class="table table-striped table-hover ">
						  <thead>
							  <tr>
							    <th width="10%"># Tour</th>
							    <th>Nombre</th>
							    <th width="20%">Hora</th>
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
						  <tbody>
						  <tr>
						    <td>01</td>
						    <td>Column content</td>
						    <td>Column content</td>
						    <td>Column content</td>
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
						  <tr>
						    <td>0.</td>
						    <td>Column content</td>
						    <td>Column content</td>
						    
						  </tr>
						  <tr>
						    <td>0.</td>
						    <td>Column content</td>
						    <td>Column content</td>
						    
						  </tr>
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


		<script>
		  $.material.init();
		</script>

	</body>

</html>