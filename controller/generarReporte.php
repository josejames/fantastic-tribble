<?php
    /* Object Oriented */
    /////////////////////////

    include("../mpdf/mpdf.php");
    $mpdf = new mPDF(”);
    //$mpdf = new mPDF('c','A4','','',32,25,27,25,16,13); 

    $stylesheet = file_get_contents('../mpdf/examples/mpdfstyletables.css');
    $mpdf->WriteHTML($stylesheet,1);
    //$mpdf->useDefaultCSS2 = true;
    

    $mpdf->SetHeader('{DATE j-m-Y : :s}| Reporte de Operadora |{PAGENO}');
    $mpdf->SetFooter('|Printed using mPDF|');


    //////////////////////////
    $texto = "ERROR: ";

        $id_tour = $_GET['id'];
        $horario = $_GET['hora'];
        $date = $_GET['date'];

        //archivo de configuracion
        include '../controller/config.php';

        $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
        //$conn = mysql_connect($hostdb, $usuariodb, $clavedb);

        /* comprobar la conexión */
        if (mysqli_connect_errno()) {
            echo $texto . mysqli_connect_error();
            /**printf("Falló la conexión: %s\n", mysqli_connect_error());**/
            exit();
        }

        $consulta_tour = "SELECT nombre_tour FROM tours WHERE id_tour=".$id_tour;
        if ($res_nombre_tour = $mysqli->query($consulta_tour)) {
            $tour_name = $res_nombre_tour->fetch_row();
                
                $mpdf->WriteHTML('<p> </p>');
                $mpdf->WriteHTML('<p> </p>');
                $mpdf->WriteHTML('<div>');
                $mpdf->WriteHTML($tour_name[0]);
                $mpdf->WriteHTML('</div>');

                $mpdf->WriteHTML('<p> </p>');
                $mpdf->WriteHTML('<p> </p>');
        }

     

        
        $consulta = 'SELECT r.id_reserva, r.id_cliente, r.clave_institucion, r.habitacion, r.num_adultos, r.num_ninos, r.num_insen FROM reserva r WHERE r.id_tour = '.$id_tour." AND r.horario = CAST('".$horario."' as TIME) AND r.fecha = CAST('".$date."' as DATE)";
        

        if ($resultado = $mysqli->query($consulta)) {

            $mpdf->WriteHTML("<table width='100%' class='bpmTopic'>");
            $mpdf->WriteHTML("<thead></thead>");
            $mpdf->WriteHTML("<tbody>");
            $mpdf->WriteHTML("<tr> <th> Cliente </th>");
            $mpdf->WriteHTML("<th> Hotel </th>");
            $mpdf->WriteHTML("<th> Habitacion </th>");
            $mpdf->WriteHTML("<th> Adultos </th>");
            $mpdf->WriteHTML("<th> Niños </th>");
            $mpdf->WriteHTML("<th> Insen </th>");
            $mpdf->WriteHTML("</tr>");


            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                //printf ("%s (%s)\n", $fila[0], $fila[1]);                                
                $data .= "<tr id=".$fila[0]." >\n";//id
                    $data .= "<td>".$fila[1]."</td>\n";//Nombre cliente

                    $consulta_name = "SELECT i.nombre_hotel FROM institucion i WHERE i.clave_hotel = '".$fila[2]."'";
                    
                    if ($resultado_name = $mysqli->query($consulta_name)) {
                        $fila_name = $resultado_name->fetch_row();
                        $data .= "<td>".$fila_name[0]."</td>\n";//Clave Hotel
                    }else{
                        $data .= "<td>".$fila[2]."</td>\n";//Clave Hotel
                    }
                    $data .= "<td>".$fila[3]."</td>\n";//Num Habitacion
                    $data .= "<td>".$fila[4]."</td>\n";//adultos
                    $data .= "<td>".$fila[5]."</td>\n";//ninos
                    $data .= "<td>".$fila[6]."</td>\n";//insen
                $data .= "</tr>\n";
                $mpdf->WriteHTML($data);
                $data = "";
            }

            /* liberar el conjunto de resultados */
            $resultado->close();
        }
        /* cerrar la conexión */
        $mysqli->close();
        $mpdf->WriteHTML("</tbody>");
        $mpdf->WriteHTML("</table>");

        $mpdf->Output(); 
        exit;
?>