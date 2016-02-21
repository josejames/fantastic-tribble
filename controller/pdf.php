<?php

	include("../mpdf/mpdf.php");
	$mpdf=new mPDF(”);

	// La variable $html es vuestro código que queréis pasar a PDF
	$html = utf8_encode($html);

	//==============================================================
	//if ($_REQUEST['html']) { echo $html; exit; }

	$mpdf->WriteHTML('<p>Hallo<p>');

	// SALIDA
	$mpdf->Output(); 
	exit;

?>