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
		        <li class="active"><a href="javascript:void(0)">Logeado como <?php echo $_SESSION["usuario"]; ?></a></li>
		        <li class="dropdown">
		          <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Tours
		            <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="../view/reservaciones.php">Reservaciones</a></li>
		            <li><a href="../view/tours.php">Revisar Tour</a></li>
		            <li class="divider"></li>
		            <li onclick="generarReporteDia()"><a href="javascript:void(0) ">Reporte de recolección</a></li>
		            <li class="divider"></li>
		            <!--
		            <li class="dropdown-header">Dropdown header</li>
		            <li><a href="javascript:void(0)">Separated link</a></li>
		            <li><a href="javascript:void(0)">One more separated link</a></li>
		        	-->
		          </ul>
		        </li>

		        <?php
		        //verificamos que sea administrador para mostrar el menu administrativo
		        if ($_SESSION['grado'] == 1) {
		        	# code...
		        
			        echo '<li class="dropdown">
			          <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Administrar
			            <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			            <li><a href="../view/usuarios.php">Usuarios </a></li>
			            <li><a href="../view/hoteles.php">Hoteles</a></li>
			            <li><a href="../view/toursadmin.php">Tours</a></li>
			            <!--<li><a href="../view/usuarios.php">Clientes</a></li>-->
			            <li><a href="../view/horarios.php">Horarios</a></li>
			            <li class="divider"></li>
			           
			          </ul>
			        </li>';
		    	}
		        ?>
		        <!-- Free version
				<li class="dropdown">
			          <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Administrar
			            <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			            <li><a href="javascript:void(0)">Usuarios </a></li>
			            <li><a href="javascript:void(0)">Hoteles</a></li>
			            <li><a href="javascript:void(0)">Tours</a></li>
			            <li><a href="javascript:void(0)">Clientes</a></li>
			            <li><a href="javascript:void(0)">Horarios</a></li>
			            <li class="divider"></li>
			           
			          </ul>
			        </li>
		    	-->

		      </ul>
		      <!--Right nav bar -->
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="../controller/terminasesion.php">Salir</a></li>
		      </ul>
		    </div>
		  </div>
		</div>


