/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#resultTable tr').click(function (event) {
          //alert($(this).attr('id')); //trying to alert id of the clicked row
          alert(this.id);
          
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

function loadHoteles(){
	//the Ajax call
	//alert("cargando");
	$.post("../controller/obtenhotel.php",null,
	       statusLoadHoteles);

}

function statusLoadHoteles(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("loadHoteles recuperados con EXITO!");
	}

}