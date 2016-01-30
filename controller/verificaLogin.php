<?php
  session_start();
  //session_destroy();

  if (!isset($_POST['inputUser']) || !isset($_POST['inputPassword']) ) {
	  header("Location: ../login.php");
  }
  if(empty($_POST['inputUser']) || empty($_POST['inputPassword'])){
    header("Location: ../login.php");
  }
  
  /*echo "user ".$_POST['inputUser'];
  echo "pass ".$_POST['inputPassword'];*/
  
  include 'config.php';

  $conn = mysqli_connect($hostdb,$usuariodb,$clavedb);
  if (!$conn) {
    echo "No se pudo hacer la conexion";
	  die("No se pudo realizar conexion ".mysqli_error());
  }
  /* comprobar la conexión */
  if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
  }
  
  mysqli_select_db($conn, $nombredb);

    /*Some security ways*/
    $cuenta = stripslashes($_POST['inputUser']);
    $cuenta = mysqli_real_escape_string($conn, $cuenta);
    $clave = stripslashes($_POST['inputPassword']);
    $clave = mysqli_real_escape_string($conn, $clave);
    $consulta = "SELECT cuenta, clave, grado FROM usuario WHERE " .
      "cuenta='".$cuenta."' AND clave='" .$clave."'";
  
  $result = mysqli_query($conn, $consulta);
  if (!$result) {
	  //echo $consulta;
	  die("Error en la consulta: ".mysql_error());
  }  
  $numregistros = mysqli_num_rows($result);
  
  if ($numregistros == 1) {
    //obtenemos los datos del usuario a logear
            
      $registro = mysqli_fetch_row($result);

      $_SESSION["clave"] = $registro[0];
      $_SESSION["usuario"] = $registro[1];
      $_SESSION["grado"] = $registro[2];
        
      echo "Usuario = ".$_SESSION["usuario"];
      echo " Password = ".$_SESSION["clave"];
      echo " Grado = ".$_SESSION["grado"];
          
      mysqli_free_result($result);
      $_SESSION["logueado"]=True;


      header("Location: ../view/reservaciones.php");	 
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>Error en Usuario</title>
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
        <h1>Oh lo sentimos, el usuario o password son incorrectos!</h1>
        <br />
        <a href="../login.php" class="alert-link">Da click aqu&iacute;!</a> e intenta nuevamente!
      </div>
    </div>
  </div>


</body>
</html>

