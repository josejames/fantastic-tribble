var tourIndex = -1;

/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#toursTable tr').click(function (event) {
     	  $('#toursTable tr').children().removeClass("success");
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
function saveTourData() {

	var result = verifyData();
	 
	if(result){
	//the data
	var data = {
			nombre : $("#inputNombre").val(),
			numero : $("#inputNumero").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/agregatour.php",message,
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
	$.post("../controller/obtentours.php",null,
	       statusLoadTours);

}

function statusLoadTours(resultado){

	if (resultado.indexOf("<tr")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("loadTours recuperados con EXITO!");
		//vaciamos la tabla
		$("#tbodyTours").empty();
		//rellenamos con la llamada ajax
		$("#tbodyTours").html(resultado);
			
			//NECESITAMOS RECARGAS EL EVENTO EN LOS TR
 		    $('#toursTable tr').click(function (event) {
     		$('#toursTable tr').children().removeClass("success");
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
	//$('#toursTable tr').children().css("background-color", "transparent");
	$('#toursTable tr').children().removeClass("success");
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
	
	$("#inputID").val(datos.numero);
	$("#inputIDHIDE").val(datos.id_tour);
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
			numero : $("#inputID").val(),
			id_tour : $("#inputIDHIDE").val()
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
		$("#tbodyTours").empty();
		loadTours();
		//here we must recharge the table
	}

}