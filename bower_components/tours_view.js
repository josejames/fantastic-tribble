var tourHorarioIndex = -1;

/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#thTable tr').click(function (event) {
     	  $('#thTable tr').children().removeClass("success");
          //alert($(this).attr('id')); //trying to alert id of the clicked row
          //alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          $(this).children().addClass("success");
          tourHorarioIndex = this.id;
          changeLog();
     });
 });

function changeLog(){

	var datos = tourHorarioIndex.split(" ");
	/*alert(datos[0]);
	alert(datos[1]);*/
	//The data
	var data = {
			//inputs from the modal form
			id_tour : datos[0],
			id_horario : datos[1],
			fecha : $("#selectFecha").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/obtenlog.php",message,
	        statusChangeLog);

}

function statusChangeLog(resultado){

	if (resultado.indexOf("<tr")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("LoadLog recuperado con EXITO!");
		//vaciamos la tabla
		$("#tbodyLog").empty();
		//rellenamos con la llamada ajax
		$("#tbodyLog").html(resultado);
			
			//NECESITAMOS RECARGAS EL EVENTO EN LOS TR
 		    /*$('#thTable tr').click(function (event) {
     		$('#thTable tr').children().removeClass("success");
          	//alert($(this).attr('id')); //trying to alert id of the clicked row
          	//alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          	$(this).children().addClass("success");
          	tourHorarioIndex = this.id;
          
			});
		tourHorarioIndex = -1;*/
	}

}

/********************************************************/
/* Function to retrieve the data from the hotel admin   */
/*      form                                            */
/********************************************************/
function saveHorarioData() {


	alert($("#inputTime").val());
	/*var result = verifyData();
	 
	if(result){
	//the data
	var data = {
			nombre : $("#inputNombre").val(),
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
	}*/
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
 		    $('#thTable tr').click(function (event) {
     		$('#thTable tr').children().removeClass("success");
          	//alert($(this).attr('id')); //trying to alert id of the clicked row
          	//alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          	$(this).children().addClass("success");
          	tourHorarioIndex = this.id;
          
			});
		tourHorarioIndex = -1;
	}

}

/**************************************/
/* Ccargar los datos del hotel dentro */
/* del form de actualizar el registro */
/*                                    */
/**************************************/
function modificarTour(){

	alert("Usuario Index "+tourHorarioIndex);
	//$('#thTable tr').children().css("background-color", "transparent");
	$('#thTable tr').children().removeClass("success");
	//tourHorarioIndex = null;
	//MAkE THE AJAX CALL to get the hotel
	var id_tour = tourHorarioIndex;
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
		$("#tbodyTours").empty();
		loadTours();
		//here we must recharge the table
	}

}