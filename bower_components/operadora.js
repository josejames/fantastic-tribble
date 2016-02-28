var hotelIndex = -1;

/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#tbodyHotel tr').click(function (event) {
     	  $('#tbodyHotel tr').children().removeClass("success");
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
		if (resultado.indexOf("Duplicate")!=-1) {
			alert("La clave de hotel "+$("#inputClave").val().toUpperCase()+" ya existe");
		} else{
			alert(resultado);
		}
	} 		 
	else {
		alert("Hotel agregado con EXITO!");
		loadHoteles();
	}

}

/********************************************************/
/* Function to verify the data from the hotel admi      */
/*      form                                            */
/********************************************************/
function verifyData(){
	return true;
}

function loadHoteles(){
	//the Ajax call
	//alert("cargando");
	$.post("../controller/obtenhoteles.php",null,
	       statusLoadHoteles);

}

function statusLoadHoteles(resultado){

	if (resultado.indexOf("<tr")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		//alert("loadHoteles recuperados con EXITO!");
		$("#tbodyHotel").html(resultado);
			
			//NECESITAMOS RECARGAS EL EVENTO EN LOS TR
 		    $('#tbodyHotel tr').click(function (event) {
     		$('#tbodyHotel tr').children().removeClass("success");
          	//alert($(this).attr('id')); //trying to alert id of the clicked row
          	//alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          	$(this).children().addClass("success");
          	hotelIndex = this.id;
          
			});
		
	}

}

/**************************************/
/* Ccargar los datos del hotel dentro */
/* del form de actualizar el registro */
/*                                    */
/**************************************/
function modificarHotel(){

	//alert("Hotel Index "+hotelIndex);
	//$('#tbodyHotel tr').children().css("background-color", "transparent");
	$('#tbodyHotel tr').children().removeClass("success");
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


/******************************************/
/**/
/**/
/**/
/*******************************************/

function updateHotel() {

	var result = verifyData();

	if(result && hotelIndex != -1){
	//the data
	var data = {
			//inputs from the modal form
			nombre : $("#inputNombre2").val(),
			clave : $("#inputClave2").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/updatehotel.php",message,
	        statusUpdatedHotel);
	}
	else{
		$("#message").html("Debes Completar todos los campos :)");
	}
	
}

function statusUpdatedHotel(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Hotel Actualizado Con EXITO!");
		$("#tbodyHotel").empty();
		loadHoteles();
		//here we must recharge the table
	}

}

function eliminarHotel(){
if (hotelIndex != -1) {
		//
		if(confirm("Seguro de eliminar "+hotelIndex+"?"))
			{
			    var id_hotel = hotelIndex;
				$.post("../controller/eliminahotel.php","id_hotel="+escape(id_hotel),statusEliminaHotel);
			}			
	}

}
function statusEliminaHotel(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Hotel eliminado!");
		//$("#tbodyUsuario").empty();
		loadHoteles();
		hotelIndex = -1;
		//here we must recharge the table
	}	

}