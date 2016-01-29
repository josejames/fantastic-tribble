<!DOCTYPE html>
<html>

	<head>

		<title>Operadora Login</title>
		<!--
		Scripts
		-->
		<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	  <!-- Mobile support -->
	  <meta name="viewport" content="width=device-width, initial-scale=1">

			 <!-- Material Design fonts -->
	  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	  <!-- Bootstrap -->
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

	  <!-- Bootstrap Material Design -->
	  <link href="bower_components/bootstrap-material-design/dist/css/bootstrap-material-design.css" rel="stylesheet">
	  <link href="bower_components/bootstrap-material-design/dist/css/ripples.min.css" rel="stylesheet">


	  <link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">

	  	<script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
	  	<script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	  	<script src="bower_components/bootstrap-material-design/dist/js/ripples.min.js"></script>
		<script src="bower_components/bootstrap-material-design/dist/js/material.min.js"></script>
		<script src="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.js"></script>

		<script type="text/javascript" src="bower_components/operadora.js"></script>
	</head>


	<body>

		<!--
		Navegacion
		-->
		<nav>
			<div class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="javascript:void(0)">Operadora</a>
			    </div>
			    <div class="navbar-collapse collapse navbar-responsive-collapse">
			      <ul class="nav navbar-nav">
			        <li><a href="javascript:void(0)">Bienvenido, primero debes autenticarte!</a></li>
			      </ul>
			    </div>
			  </div>
			</div>
		</nav>

		<!--
		End Navegacion
		-->


		<!--
		Contenido
		-->
		<div class="row">
		
			<div class="col-md-2">
			</div>

      		<div class="col-md-8">
        		<div class="well bs-component">

	
					<form class="form-horizontal" action="controller/verificaLogin.php" method="POST">
					  
					  <fieldset>

					    <legend>Login Operadora</legend>
					    
					    <div class="form-group-lg">
					      <label for="inputUser" class="col-md-2 control-label-lg">Usuario</label>

					      <div class="col-md-10">
					        <input type="text" name="inputUser" class="form-control" id="inputUser" placeholder="Usuario">
					      </div>
					    </div>
					    <div class="form-group-lg">
					      <label for="inputPassword" class="col-md-2 control-label-lg">Password</label>

					      <div class="col-md-10">
					        <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Password">
					      </div>
					    </div>

					    <!--Submit -->
					    <div class="form-group-lg">
					      <div class="col-md-10 col-md-offset-2">
					        <!--<button type="button" class="btn btn-default">Cancel</button>-->
					        <button type="submit" class="btn btn-primary">Submit</button>
					      </div>
					    </div>


					  </fieldset>
					</form>

				</div>
			</div>
		</div> <!--Div row form -->

		<!--
		End Contenido
		-->


		<footer>


		</footer>

		<script>
		  $.material.init();
		</script>

	</body>

</html>