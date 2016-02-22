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
		
		if(!resultado){
			alert("Conjunto vacio de datos");
			$("#tbodyLog").empty();
		}
		else{
			//algo ocurrio mal 
			alert(resultado);
		}
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
/* Function to verify the data from the hotel admi      */
/*      form                                            */
/********************************************************/

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

/******************************************/
/* Function */
/**/
/**/
/*******************************************/



function cambiaLog(){
	//alert($("#selectFecha").val());
	if(tourHorarioIndex != -1){
		changeLog();
	}
}

function generar(){


	if(tourHorarioIndex != -1){
		
		var datos = tourHorarioIndex.split(" ");
		var id_tour = datos[0];
		var horario = datos[1];

		var url = '../controller/generarReporte.php?date='+ $("#selectFecha").val()+"&id="+id_tour+"&hora="+horario;
		window.open(url,'Reporte', 'width=800, height=600');
		
	}
	else{
		alert("Primero debes elegir un Tour");
	}
}

function generarReporteDia(){

	var url = '../controller/generarReporteDia.php';
	window.open(url,'Reporte', 'width=800, height=600');				
	
}