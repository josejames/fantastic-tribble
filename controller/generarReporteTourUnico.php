<?php
    /******************************/ 
    /* Generar reporte del dia    */
    /* Para un solo tour          */
    /******************************/
    $id_tour = $_GET['id'];
    $horario = $_GET['horario'];
    $date = $_GET['date'];
    $table_header = "";

    include("../mpdf/mpdf.php");
    $mpdf = new mPDF(”);
    
    //the table stylesheet
    $stylesheet = file_get_contents('../mpdf/examples/mpdfstyletables.css');
    $mpdf->WriteHTML($stylesheet,1);
    /*$table_css = file_get_contents('../bower_components/table_report.css');
    $mpdf->WriteHTML($table_css,1);*/


    //$mpdf->useDefaultCSS2 = true;
    
    //set header and footer to the pdf
    $mpdf->SetHeader('{DATE j-m-Y  h:i:s}| <h5>Operadora Zacatecas S.A de C.V<h5> |{PAGENO}');
    $mpdf->SetFooter('|Operadora|');
    $mpdf->WriteHTML('<br/>');

    

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

        $consulta_tour = "SELECT nombre_tour, numero_tour FROM tours WHERE id_tour=".$id_tour;
        //$mpdf->WriteHTML($consulta_tour);
        if ($res_nombre_tour = $mysqli->query($consulta_tour)) {
            $tour_name = $res_nombre_tour->fetch_row();
                
                if ($tour_name[1] <= 9) {
                    $tour_name[1] = "0".$tour_name[1];
                }

                $table_header = $tour_name[1]." ".$tour_name[0]." ".$horario;

                //$mpdf->WriteHTML($table_header);
        }
        $mpdf->WriteHTML('<p style="text-align:center; "><b>Reporte de Tour '.$table_header.'</b></p>');

        date_default_timezone_set('America/Mexico_City');
        $fecha = date("Y-m-d"); 

        
        $consulta = 'SELECT r.id_reserva, r.id_cliente, r.clave_institucion, r.habitacion, r.num_adultos, r.num_ninos, r.num_insen FROM reserva r WHERE r.id_tour = '.$id_tour." AND r.horario = CAST('".$horario."' as TIME) AND r.fecha ='".$fecha."'";
            

        if ($resultado = $mysqli->query($consulta)) {

            $mpdf->WriteHTML("<table width='100%' border='0' >");
            $mpdf->WriteHTML("<thead><tr style='background-color: #e0e0d1;'><th colspan='7' align='left'>");
            $mpdf->WriteHTML($table_header);
            $mpdf->WriteHTML("</th></tr></thead>");

            $mpdf->WriteHTML("<tbody style='text-align: left;'>");
            $mpdf->WriteHTML("<tr> <th width='8%' style='border-bottom: 1px solid #000000;'>Hab.</th>");
            $mpdf->WriteHTML("<th width='25%' style='border-bottom: 1px solid #000000;'> CLIENTE </th>");
            $mpdf->WriteHTML("<th style='border-bottom: 1px solid #000000;'> ADULTOS </th>");
            $mpdf->WriteHTML("<th style='border-bottom: 1px solid #000000;'> MENORES </th>");
            $mpdf->WriteHTML("<th style='border-bottom: 1px solid #000000;'> INSEN </th>");
            $mpdf->WriteHTML("<th style='border-bottom: 1px solid #000000;'> HORARIO </th>");
            $mpdf->WriteHTML("<th style='border-bottom: 1px solid #000000;'> HOTEL </th>");
            $mpdf->WriteHTML("</tr>");


            /* obtener el array de objetos */
            while ($fila = $resultado->fetch_row()) {
                //printf ("%s (%s)\n", $fila[0], $fila[1]);                                
                $data .= "<tr id=".$fila[0]." >\n";//id de la reserva

                    //columnas
                    $data .= "<td style='border-bottom: 1px solid #000000;'>".$fila[3]."</td>\n";//Num Habitacion
                    $data .= "<td style='border-bottom: 1px solid #000000;'>".$fila[1]."</td>\n";//Nombre cliente
                    $data .= "<td style='border-bottom: 1px solid #000000;'>".$fila[4]."</td>\n";//adultos
                    $data .= "<td style='border-bottom: 1px solid #000000;'>".$fila[5]."</td>\n";//ninos
                    $data .= "<td style='border-bottom: 1px solid #000000;'>".$fila[6]."</td>\n";//insen
                    $data .= "<td style='border-bottom: 1px solid #000000;'>".$horario."</td>\n";//horario


                    $consulta_name = "SELECT i.nombre_hotel FROM institucion i WHERE i.clave_hotel = '".$fila[2]."'";
                    
                    if ($resultado_name = $mysqli->query($consulta_name)) {
                        $fila_name = $resultado_name->fetch_row();
                        $data .= "<td style='border-bottom: 1px solid #000000;'>".$fila_name[0]."</td>\n";//Nombre Hotel
                    }else{
                        $data .= "<td style='border-bottom: 1px solid #000000;'>".$fila[2]."</td>\n";//Clave Hotel
                    }                    
                    
                $data .= "</tr>\n";
                $mpdf->WriteHTML($data);
                $data = "";
            }//end while llenado de tabla

            $sql_num = 'SELECT  SUM(r.num_adultos), SUM(r.num_ninos), SUM(r.num_insen) FROM reserva r WHERE r.id_tour = '.$id_tour." AND r.horario = CAST('".$horario."' as TIME) AND r.fecha ='".$fecha."'";

            if ($res_num = $mysqli->query($sql_num)) {
                //obtenemos la suma de los numeros
                $numeros = $res_num->fetch_row();
                $mpdf->WriteHTML("<tr><td colspan='2'></td><td colspan='4'  style='border-bottom: 1px solid #000000;'>&nbsp;</td></tr>");

                $mpdf->WriteHTML("<tr>");
                $mpdf->WriteHTML("<td colspan='2'>Cantidad de Personas</td>");
                $mpdf->WriteHTML("<td>".$numeros[0]."</td>");
                $mpdf->WriteHTML("<td>".$numeros[1]."</td>");
                $mpdf->WriteHTML("<td>".$numeros[2]."</td>");

                $total = $numeros[0]+$numeros[1]+$numeros[2];
                $mpdf->WriteHTML("<td colspan='2'> TOTAL = ".$total."</td>");
                $mpdf->WriteHTML("</tr>");

            }
            //$mpdf->WriteHTML("<tr><th>".$fila[7]."</th></tr>");
            //cerramos la tabla
            $mpdf->WriteHTML("</tbody>");
            $mpdf->WriteHTML("</table>");
            
            /* liberar el conjunto de resultados */
            $resultado->close();
        }
        /* cerrar la conexión */
        $mysqli->close();
       

        $mpdf->Output(); 
        exit;
?>