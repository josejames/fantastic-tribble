<?php
    
    $id_tour = $_GET['id'];
    $horario = $_GET['hora'];
    $date = $_GET['date'];
    $table_header = "";

    include("../mpdf/mpdf.php");
    $mpdf = new mPDF(”);
    
    //the table stylesheet
    $stylesheet = file_get_contents('../mpdf/examples/mpdfstyletables.css');
    $mpdf->WriteHTML($stylesheet,1);
    //$mpdf->useDefaultCSS2 = true;
    
    //set header and footer to the pdf
    $mpdf->SetHeader('{DATE j-m-Y  h:i:s}| Reporte de Operadora |{PAGENO}');
    $mpdf->SetFooter('|Printed using mPDF|');


    $texto = "ERROR: ";

        //archivo de configuracion
        include 'config.php';

        $mysqli = new mysqli($hostdb, $usuariodb, $clavedb, $nombredb);
       
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

                $table_header = $tour_name[0];
                //$mpdf->WriteHTML($table_header);
                
                $mpdf->WriteHTML('</div>');

                $mpdf->WriteHTML('<p> </p>');
                $mpdf->WriteHTML('<p> </p>');
        }

     

        
        $consulta = 'SELECT r.id_reserva, r.id_cliente, r.clave_institucion, r.habitacion, r.num_adultos, r.num_ninos, r.num_insen FROM reserva r WHERE r.id_tour = '.$id_tour." AND r.horario = CAST('".$horario."' as TIME) AND r.fecha = CAST('".$date."' as DATE)";
        

        if ($resultado = $mysqli->query($consulta)) {

            $mpdf->WriteHTML("<table width='100%' class='bpmTopnTail'>");
            $mpdf->WriteHTML("<thead><tr><th colspan='3'>");
            $mpdf->WriteHTML($table_header);
            $mpdf->WriteHTML("</th></tr></thead>");

            $mpdf->WriteHTML("<tbody>");
            $mpdf->WriteHTML("<tr> <th> No. Hab. </th>");
            $mpdf->WriteHTML("<th> CLIENTE </th>");
            $mpdf->WriteHTML("<th> ADULTOS </th>");
            $mpdf->WriteHTML("<th> MENORES </th>");
            $mpdf->WriteHTML("<th> INSEN </th>");
            $mpdf->WriteHTML("<th> HORARIO </th>");
            $mpdf->WriteHTML("<th> HOTEL </th>");
            $mpdf->WriteHTML("</tr>");


            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                //printf ("%s (%s)\n", $fila[0], $fila[1]);                                
                $data .= "<tr id=".$fila[0]." >\n";//id de la reserva

                    //columnas
                    $data .= "<td>".$fila[3]."</td>\n";//Num Habitacion
                    $data .= "<td>".$fila[1]."</td>\n";//Nombre cliente
                    $data .= "<td>".$fila[4]."</td>\n";//adultos
                    $data .= "<td>".$fila[5]."</td>\n";//ninos
                    $data .= "<td>".$fila[6]."</td>\n";//insen
                    $data .= "<td>".$horario."</td>\n";//horario


                    $consulta_name = "SELECT i.nombre_hotel FROM institucion i WHERE i.clave_hotel = '".$fila[2]."'";
                    
                    if ($resultado_name = $mysqli->query($consulta_name)) {
                        $fila_name = $resultado_name->fetch_row();
                        $data .= "<td>".$fila_name[0]."</td>\n";//Nombre Hotel
                    }else{
                        $data .= "<td>".$fila[2]."</td>\n";//Clave Hotel
                    }
                    
                    
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