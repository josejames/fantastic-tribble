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
			procedencia : $("#selectProcedencia").val(),
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
		//$("#formaReservacion").trigger("reset");
	}
}


function verifyData(){
	return true;
}