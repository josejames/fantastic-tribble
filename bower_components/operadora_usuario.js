var usuarioIndex = -1;

/***********************************/
/* Archivo de Script para procesar */
/* los archivos de operadora       */
/* haciendo uso de jquery          */
/* version 1.0                     */
/***********************************/
$(document).ready(function () {      
     $('#usuarioTable tr').click(function (event) {
     	  $('#usuarioTable tr').children().removeClass("success");
          //alert($(this).attr('id')); //trying to alert id of the clicked row
          //alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          $(this).children().addClass("success");
          usuarioIndex = this.id;
          
     });
 });


/********************************************************/
/* Function to retrieve the data from the hotel admin   */
/*      form                                            */
/********************************************************/
function saveUsuarioData() {

	var result = verifyData();
	var isAdmin;

	if($("#inputAdmin").is(':checked')) {  
    	//alert("Admin");
    	isAdmin = 1;
    } else {  
        //alert("No admin");
        isAdmin = 2;
    }  

	if(result){
	//the data
	var data = {
			nombre : $("#inputNombre").val(),
			apPat : $("#inputAp").val(),
			apMat : $("#inputAm").val(),
			admin : isAdmin,
			cuenta : $("#inputCuenta").val(),
			pass : $("#inputPassword").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/agregausuario.php",message,
	        statusSaveUsuario);
	}
	else{
		$("#message").html("Debes Completar todos los campos :)");
	}
	
}

/********************************************************/
/* Function to recive the status of the inserted        */
/* record in the institucion table in the db            */
/********************************************************/
function statusSaveUsuario(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Usuario agregado con EXITO!");
		loadUsuarios();
	}

}

/********************************************************/
/* Function to verify the data from the hotel admi      */
/*      form                                            */
/********************************************************/
function verifyData(){
	return true;
}

function loadUsuarios(){
	//the Ajax call
	//alert("cargando");
	$.post("../controller/obtenusuarios.php",null,
	       statusLoadUsuarios);

}

function statusLoadUsuarios(resultado){

	if (resultado.indexOf("<tr")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("loadUsuarios recuperados con EXITO!");
		//vaciamos la tabla
		$("#tbodyUsuario").empty();
		//rellenamos con la llamada ajax
		$("#tbodyUsuario").html(resultado);
			
			//NECESITAMOS RECARGAS EL EVENTO EN LOS TR
 		    $('#usuarioTable tr').click(function (event) {
     		$('#usuarioTable tr').children().removeClass("success");
          	//alert($(this).attr('id')); //trying to alert id of the clicked row
          	//alert(this.id + " Hola"+ $(this).children().css("background-color", "red"));
          	$(this).children().addClass("success");
          	usuarioIndex = this.id;
          
			});
		usuarioIndex = -1;
	}

}

/**************************************/
/* Ccargar los datos del hotel dentro */
/* del form de actualizar el registro */
/*                                    */
/**************************************/
function modificarUsuario(){

	alert("Usuario Index "+usuarioIndex);
	//$('#usuarioTable tr').children().css("background-color", "transparent");
	$('#usuarioTable tr').children().removeClass("success");
	//usuarioIndex = null;
	//MAkE THE AJAX CALL to get the hotel
	var id_usuario = usuarioIndex;
	$.getJSON("../controller/obtenusuario.php","id_usuario="+escape(id_usuario),statusGetUsuario);
	
}

/**/
/*function getHotel() {
	var id_hotel = $("#Peli").val();
	$.getJSON("obtenhotel.php","id_hotel="+escape(id_hotel),statusGetHotel);
}*/

function statusGetUsuario(datos){
	
	$("#inputNombre2").val(datos.nombre);
	$("#inputAp2").val(datos.apPat);
	$("#inputAm2").val(datos.apMat);
	if (datos.grado == "1") {
		$("#inputAdmin2").attr('checked', true);
	}else{
		$("#inputAdmin2").attr('checked', false);
	}
	$("#inputCuenta2").val(datos.cuenta);

}


/******************************************/
/* Function */
/**/
/**/
/*******************************************/

function updateUsuario() {

	var result = verifyData();
	var isAdmin;

	if($("#inputAdmin2").is(':checked')) {  
    	//alert("Admin");
    	isAdmin = 1;
    } else {  
        //alert("No admin");
        isAdmin = 2;
    }

	if(result){
	//the data
	var data = {
			//inputs from the modal form
			nombre : $("#inputNombre2").val(),
			apPat : $("#inputAp2").val(),
			apMat : $("#inputAm2").val(),
			admin : isAdmin,
			cuenta : $("#inputCuenta2").val()
	}
	//alert("Hola");
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/updateusuario.php",message,
	        statusUpdatedUsuario);
	}
	else{
		$("#message").html("Debes Completar todos los campos :)");
	}
	
}

function statusUpdatedUsuario(resultado){

	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Usuario Actualizado Con EXITO!");
		$("#tbodyUsuario").empty();
		loadUsuarios();
		//here we must recharge the table
	}

}