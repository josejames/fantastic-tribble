<!DOCTYPE html>
<html>

<head>
<title>Error</title>
<meta http-equiv="Content-type" content="text/html;charset=ISO-8859-1" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile support -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
    include '../basics/estilos.php';
    include '../basics/scripts.php';
  ?>

  

  

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
              <li><a href="javascript:void(0)">Creo que tenemos un error!</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!--
    End Navegacion
    -->




  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <div class="alert alert-dismissible alert-danger">
        <!--<button type="button" class="close" data-dismiss="alert">×</button>-->
        <h1>Oh lo sentimos, pero no tienes los permisos suficientes para acceder!</h1>
        <br />
        <!--<a href="../login.php" class="alert-link">Da click aqu&iacute;!</a> e intenta nuevamente!-->
      </div>
    </div>
  </div>


</body>
</html>
