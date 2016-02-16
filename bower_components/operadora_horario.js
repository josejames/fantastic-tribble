var tourIndex = -1;

/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#horariosTable tr').click(function (event) {
     	  $('#horariosTable tr').children().removeClass("success");
          //alert($(this).attr('id')); //trying to alert id of the clicked row
          //alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          $(this).children().addClass("success");
          tourIndex = this.id;
          
     });
 });


/********************************************************/
/* Function to retrieve the data from the hotel admin   */
/*      form                                            */
/********************************************************/
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
		alert("Tour agregado con EXITO!");
		loadTours();
	}

}

/********************************************************/
/* Function to verify the data from the hotel admi      */
/*      form                                            */
/********************************************************/
function verifyData(){
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
		alert("loadHorarios recuperados con EXITO!");
		//vaciamos la tabla
		$("#tbodyHorarios").empty();
		//rellenamos con la llamada ajax
		$("#tbodyHorarios").html(resultado);
			
			//NECESITAMOS RECARGAS EL EVENTO EN LOS TR
 		    $('#horariosTable tr').click(function (event) {
     		$('#horariosTable tr').children().removeClass("success");
          	//alert($(this).attr('id')); //trying to alert id of the clicked row
          	//alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          	$(this).children().addClass("success");
          	tourIndex = this.id;
          
			});
		tourIndex = -1;
	}

}

/**************************************/
/* Ccargar los datos del hotel dentro */
/* del form de actualizar el registro */
/*                                    */
/**************************************/
function modificarTour(){

	alert("Usuario Index "+tourIndex);
	//$('#horariosTable tr').children().css("background-color", "transparent");
	$('#horariosTable tr').children().removeClass("success");
	//tourIndex = null;
	//MAkE THE AJAX CALL to get the hotel
	var id_tour = tourIndex;
	$.getJSON("../controller/obtentour.php","id_tour="+escape(id_tour),statusGetTour);
	
}

/**/
/*function getHotel() {
	var id_hotel = $("#Peli").val();
	$.getJSON("obtenhotel.php","id_hotel="+escape(id_hotel),statusGetHotel);
}*/

function statusGetTour(datos){
	
	$("#inputID").val(datos.id_tour);
	$("#inputNombre2").val(datos.nombre);
	
}


/******************************************/
/* Function */
/**/
/**/
/*******************************************/

function updateTour() {

	var result = verifyData();

	if(result){
	//the data
	var data = {
			//inputs from the modal form
			nombre : $("#inputNombre2").val(),
			id_tour : $("#inputID").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/updatetour.php",message,
	        statusUpdatedTour);
	}
	else{
		$("#message").html("Debes Completar todos los campos :)");
	}
	
}

function statusUpdatedTour(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Tour Actualizado Con EXITO!");
		$("#tbodyHorarios").empty();
		loadTours();
		//here we must recharge the table
	}

}