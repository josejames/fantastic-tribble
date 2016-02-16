

  	<script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
  	<script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  	<script src="../bower_components/bootstrap-material-design/dist/js/ripples.min.js"></script>
  	<script src="../bower_components/bootstrap-material-design/dist/js/material.min.js"></script>
  	<script type="text/javascript" src="../bower_components/operadora.js"></script>
	<script src="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.js"></script>


	<!--jqueryUI-->
		<script type="text/javascript" src="../bower_components/jquery-ui/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

		<!-- Date Picker-->
		<script type="text/javascript">
			$(function() {
	    		$( "#inputFecha" ).datepicker({ minDate: 0, dateFormat : "yy-mm-dd" });
	    		$( "#inputFecha" ).datepicker("setDate", new Date());
	    		$( "#selectFecha" ).datepicker({ dateFormat : "yy-mm-dd" });
	    		$( "#selectFecha" ).datepicker("setDate", new Date());
	    		//alert($("#inputHorario").datepicker("getDate"));
	  		});
		</script>