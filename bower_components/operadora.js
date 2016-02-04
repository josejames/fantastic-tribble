var hotelIndex;

/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#resultTable tr').click(function (event) {
     	  $('#resultTable tr').children().removeClass("success");
          //alert($(this).attr('id')); //trying to alert id of the clicked row
          //alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          $(this).children().addClass("success");
          hotelIndex = this.id;
          
     });
 });
/********************************************************/
/* Function to retrieve the data from the hotel admin   */
/*      form                                            */
/********************************************************/
function savetHotelData() {

	var result = verifyData();

	if(result){
	//the data
	var data = {
			nombre : $("#inputNombre").val(),
			clave : $("#inputClave").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/agregahotel.php",message,
	        statusSaveHotel);
	}
	else{
		$("#message").html("Debes Completar todos los campos :)");
	}
	
}

/********************************************************/
/* Function to recive the status of the inserted        */
/* record in the institucion table in the db            */
/********************************************************/
function statusSaveHotel(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Hotel agregado con EXITO!");
	}

}

/********************************************************/
/* Function to verify the data from the hotel admi      */
/*      form                                            */
/********************************************************/
function verifyData(){
	return true;
}

/*function loadHoteles(){
	//the Ajax call
	//alert("cargando");
	$.post("../controller/obtenhotel.php",null,
	       statusLoadHoteles);

}*/

function statusLoadHoteles(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("loadHoteles recuperados con EXITO!");
	}

}

function modificarHotel(){

	alert("Hotel Index "+hotelIndex);
	//$('#resultTable tr').children().css("background-color", "transparent");
	$('#resultTable tr').children().removeClass("success");
	//hotelIndex = null;
	//MAkE THE AJAX CALL to get the hotel
	var id_hotel = hotelIndex;
	$.getJSON("../controller/obtenhotel.php","id_hotel="+escape(id_hotel),statusGetHotel);
}

/**/
/*function getHotel() {
	var id_hotel = $("#Peli").val();
	$.getJSON("obtenhotel.php","id_hotel="+escape(id_hotel),statusGetHotel);
}*/

function statusGetHotel(datos){
	
	$("#inputNombre2").val(datos.nombre_hotel);
	$("#inputClave2").val(datos.clave)


}