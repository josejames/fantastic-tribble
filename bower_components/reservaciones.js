/********************************************/
/********************************************/
/********************************************/
/********************************************/
/********************************************/
/********************************************/


function cargaHorarios(){

	var id_tour = $("#selectRecorrido").val();
	//alert(id_tour);
	$.post("../controller/getHorarios.php","id_tour="+escape(id_tour),status);
}


function status(resultado){

	$("#selectHorario").empty();
	$("#selectHorario").html(resultado);
	//alert("hey");
}



function algo(){
	alert("Hola");

}

function  saveReservacion(){

	var result = verifyData();

	if(result){
	//the data
	var data = {
			cliente : $("#inputName").val(),
			habitacion : $("#inputHabitacion").val(),
			procedencia : "N/A",
			id_hotel : $("#selectHotel").val(),
			id_tour : $("#selectRecorrido").val(),
			horario : $("#selectHorario").val(),
			fecha : $("#inputFecha").val(),
			adultos : $("#inputAd").val(),
			ninios : $("#inputNi").val(),
			insen : $("#inputIn").val()
	}
	
	var message="info="+
	         escape(JSON.stringify(data))

	//the Ajax call
	$.post("../controller/agregareserva.php",message,
	        statusSaveReserva);

	}
	else{
		$("#message").html("Debes Completar todos los campos :)");
	}

}

function statusSaveReserva(resultado){
	if (resultado.indexOf("EXITO")==-1) {
		//algo ocurrio mal
		alert(resultado);
	} 		 
	else {
		alert("Reservacion Guardada!");
		resetForm();
	}
}


function verifyData(){
	
	if (!$("#inputName").val()){
		alert("Debes agregar un nombre de cliente");
		return false;
	}
	if(!$("#inputHabitacion").val()){
		alert("Debes colcar un numero de habitacion");
		return false;
	}
	if($("#selectRecorrido").val() == -1){
		alert("Debes seleccionar un recorrido valido");
		return false;
	}
	if (!$("#inputAd").val() && !$("#inputNi").val() && !$("#inputIn").val()) {
		alert("Debe haber al menos una persona en la reservacion");
		return false;
	}

	return true;

}

function resetForm(){
	$("#inputName").val("");
	$("#inputHabitacion").val("");
	$("#selectProcedencia")[0].selectedIndex = 0
	$("#selectHotel")[0].selectedIndex = 0
	//$("#selectProcedencia").val("");
	//$("#selectHotel").val("");
	$("#inputAd").val("");
	$("#inputNi").val("");
	$("#inputIn").val("");
}