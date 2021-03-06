var tourIndex = -1;

/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#tbodyHorarios tr').click(function (event) {
     	  $('#tbodyHorarios tr').children().removeClass("success");
          //alert($(this).attr('id')); //trying to alert id of the clicked row
          //alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          $(this).children().addClass("success");
          tourIndex = this.id;
          
     });
 });


/**********************************************************/
/* Function to retrieve the data from the horario admin   */
/*      form                                              */
/**********************************************************/
function saveHorarioData() {


	//alert($("#inputTime").val());
	//alert($("#selectTour").val());
	var result = verifyData();
	var horario = $("#inputTime").val()+":00";
	 
	if(result){
	//the data
	var data = {
			horario : horario,
			id_tour : $("#selectTour").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/agregahorario.php",message,
	        statusSaveTour);
	}
	else{
		$("#message").html("Debes Completar todos los campos :)");
	}
}

/********************************************************/
/* Function to recive the status of the inserted        */
/* record in the institucion table in the db            */
/********************************************************/
function statusSaveTour(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Horario agregado con EXITO!");
		$("#formHorariosTour").trigger("reset");
		loadTours();
	}

}

/********************************************************/
/* Function to verify the data from the hotel admi      */
/*      form                                            */
/********************************************************/
function verifyData(){
	if ( ! $("#inputTime").val()) {
		return false;
	}
	return true;
}

function loadTours(){
	//the Ajax call
	//alert("cargando");
	$.post("../controller/obtenhorarios.php",null,
	       statusLoadTours);

}

function statusLoadTours(resultado){

	if (resultado.indexOf("<tr")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		//alert("loadHorarios recuperados con EXITO!");
		//vaciamos la tabla
		$("#tbodyHorarios").empty();
		//rellenamos con la llamada ajax
		$("#tbodyHorarios").html(resultado);
			
			//NECESITAMOS RECARGAS EL EVENTO EN LOS TR
 		    $('#tbodyHorarios tr').click(function (event) {
     		$('#tbodyHorarios tr').children().removeClass("success");
          	//alert($(this).attr('id')); //trying to alert id of the clicked row
          	//alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          	$(this).children().addClass("success");
          	tourIndex = this.id;
          
			});
		tourIndex = -1;
	}

}

/***********************************************/
/******* Eliminar Registro de horarios *********/
/***********************************************/
/***********************************************/

function eliminarHorario(){

	if (tourIndex != -1) {
		//MAkE THE AJAX CALL
		if(confirm("Seguro de eliminar el Horario seleccionado?"))
			{
			var indice = tourIndex.split(" ");
			//alert(indice[0]);
			//alert(indice[1]);

			var data = {
				horario : indice[1],
				id_tour : indice[0]
			}
		
			var message="info="+
		         escape(JSON.stringify(data))

			//the Ajax call
			$.post("../controller/eliminahorario.php",message,
		        statusElimina);
		}
	}else{
		//alert("Para eliminar primero debes seleccionar un registro");
	}
}

function statusElimina(resultado){
	
	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Horario removido!");
		tourIndex = -1;
		loadTours();
		//here we must recharge the table
	}
}