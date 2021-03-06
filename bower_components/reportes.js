/*********************************************/
/* Archivo jquery para manejar la apertura   */
/* de reportes                               */
/*                                           */
/*********************************************/


function generarReportes(){
	
	if ($("#checkTour").is(':checked')) {
		//alert("Todos");
		generarReporteTodos();
	}else{
		//alert("solo horario"+$("#selectHorario").val());
		generarReporteHorario();
	}

}

function generarReporteUnTour(){
	var total = $("#selectTour").val();
	var valores = total.split(" ");

	var idTour = valores[0];
	var horario = valores[1];

	if (idTour != -1) {
		//alert("Hey! "+idTour+ " "+horario);
		var url = '../controller/generarReporteTourUnico.php?id='+idTour+"&horario="+horario;
		window.open(url,'Reporte de un Único Tour', 'width=800, height=600');
	};
}

/*********************************************/
/* Funcion para cargar un reporte con solo   */
/* El horario especificado                   */
/*********************************************/
function generarReporteHorario(){

	var horario = $("#selectHorario").val();
	
	if (horario != -1) {		
		var url = '../controller/generarReporteTourHora.php?horario='+horario;
		window.open(url,'Reporte del Dia', 'width=800, height=600');
	}	
	
}

function generarReporteTodos(){
	
	var url = '../controller/generarReporteDia.php';
	window.open(url,'Reporte de Todos los Tours y Horarios', 'width=800, height=600');
}

function generarReportesH(){
	if ($("#checkHora").is(':checked')) {
		//alert("Todos");
		generarReporteHoteles();
	}else{
		//alert("solo horario"+$("#selectHotelHora").val());
		generarReporteHotelHorario();
	}
}


function generarReporteHoteles(){
	var url = '../controller/generarReporteHoteles.php';
	window.open(url,'Reporte de Todos los Hoteles y Horarios', 'width=800, height=600');
}

function generarReporteHotelHorario(){

	var horario = $("#selectHotelHora").val();

	if (horario != -1) {		
		var url = '../controller/generarReporteHotelHora.php?horario='+horario;
		window.open(url,'Reporte del Dia', 'width=800, height=600');
	}	

}

function generarReporteHotelUnico(){

	var hotel = $("#selectHotelUnico").val();

	if (hotel != -1) {
		//alert("hoteles!!!!!");
		var url = '../controller/generarReporteHotelUnico.php?hotel='+hotel;
		window.open(url,'Reporte de Recolección Hotel Único', 'width=800, height=600');
	}
	
}