<?php

    /*********************************************************************/
    /* Generar el reporte del dia, Seleccion de hora                     */
    /*                                                                   */
    /*********************************************************************/

    $horario = $_GET['horario'];
    
    $table_header = "";

    include("../mpdf/mpdf.php");
    $mpdf = new mPDF(”);
    
    //the table stylesheet
    $stylesheet = file_get_contents('../mpdf/examples/mpdfstyletables.css');
    $mpdf->WriteHTML($stylesheet,1);
    //$mpdf->useDefaultCSS2 = true;
    
    //set header and footer to the pdf
    $mpdf->SetHeader('{DATE j-m-Y  h:i:s}| <h5>Operadora Zacatecas S.A de C.V<h5> |{PAGENO}');
    $mpdf->SetFooter('|Operadora|');
    $mpdf->WriteHTML('<br/>');

    $mpdf->WriteHTML('<p style="text-align:center; "><b>Reporte de Tours con horario '.$horario.'</b></p>');

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

        /************************************************************/
        /* CONSULTAR EL ID DE LOS TOURS CON EL HORARIO ESPECIFICADO */
        /************************************************************/
        //Esta consulta carga los tours
        $consulta = 'SELECT th.id_tour, t.nombre_tour, th.horario, t.numero_tour FROM tourhorario th, tours t WHERE th.id_tour = t.id_tour AND th.horario=CAST('."'".$horario."' as TIME)";

        //$consulta_tour = "SELECT nombre_tour FROM tours WHERE id_tour=".$id_tour;
        
        if ($resultado = $mysqli->query($consulta)) {
            
            while($fila = $resultado->fetch_row()){

                //Para cada tour y horario obtener TODAS sus reservas del DIA

                $fecha = date("Y-m-d");
                //$mpdf->WriteHTML('<p>'.$fecha.'</   p>');
               //$sql_reserva = 'SELECT r.id_reserva, r.id_cliente, r.clave_institucion, r.habitacion, r.num_adultos, r.num_ninos, r.num_insen FROM reserva r WHERE r.id_tour = '.$fila[0]." AND r.horario = CAST('".$fila[2]."' as TIME) AND r.fecha = CAST('".date("d-m-Y")."' as DATE)";

                $sql_reserva = 'SELECT r.id_reserva, r.id_cliente, r.clave_institucion, r.habitacion, r.num_adultos, r.num_ninos, r.num_insen FROM reserva r WHERE r.id_tour = '.$fila[0]." AND r.horario = CAST('".$fila[2]."' as TIME) AND r.fecha ='".$fecha."'";


                if ($res_reserva = $mysqli->query($sql_reserva)) {
                    //se obtuvieron las reservas

                    $row_cnt = $res_reserva->num_rows;

                    if($row_cnt != 0){
                        //generamos la tabla
                        $mpdf->WriteHTML("<table width='100%' border='1'>");
                        $mpdf->WriteHTML("<thead><tr style='background-color: #e0e0d1;'><th colspan='4' align='left'>");
                        if ($fila[3] <= 9) {
                            $fila[3] = "0".$fila[3];
                        }
                        $mpdf->WriteHTML($fila[3]." ".$fila[1]);
                        $mpdf->WriteHTML("</th>");
                        $mpdf->WriteHTML("<th align='right' colspan='3'>");
                        $mpdf->WriteHTML($fila[2]);
                        $mpdf->WriteHTML("</th>");
                        $mpdf->WriteHTML("</tr></thead>");


                        $mpdf->WriteHTML("<tbody>");
                        $mpdf->WriteHTML("<tr> <th width='8%'>Hab.</th>");
                        $mpdf->WriteHTML("<th width='25%'> CLIENTE </th>");
                        $mpdf->WriteHTML("<th> ADULTOS </th>");
                        $mpdf->WriteHTML("<th> MENORES </th>");
                        $mpdf->WriteHTML("<th> INSEN </th>");
                        $mpdf->WriteHTML("<th> HORARIO </th>");
                        $mpdf->WriteHTML("<th> HOTEL </th>");
                        $mpdf->WriteHTML("</tr>");
                    }

                    /* Para la tabla generada sacamos todas las filas de las reservas*/
                    while ($fila_reserva = $res_reserva->fetch_row()) {
                        //printf ("%s (%s)\n", $fila_reserva[0], $fila_reserva[1]);                                
                        $data .= "<tr id=".$fila_reserva[0]." >\n";//id de la reserva

                            //columnas
                            $data .= "<td>".$fila_reserva[3]."</td>\n";//Num Habitacion
                            $data .= "<td>".$fila_reserva[1]."</td>\n";//Nombre cliente
                            $data .= "<td>".$fila_reserva[4]."</td>\n";//adultos
                            $data .= "<td>".$fila_reserva[5]."</td>\n";//ninos
                            $data .= "<td>".$fila_reserva[6]."</td>\n";//insen
                            $data .= "<td>".$fila[2]."</td>\n";//horario


                            $consulta_name = "SELECT i.nombre_hotel FROM institucion i WHERE i.clave_hotel = '".$fila_reserva[2]."'";
                            
                            if ($resultado_name = $mysqli->query($consulta_name)) {
                                $fila_name = $resultado_name->fetch_row();
                                $data .= "<td>".$fila_name[0]."</td>\n";//Nombre Hotel
                            }else{
                                $data .= "<td>".$fila_reserva[2]."</td>\n";//Clave Hotel
                            }
                            
                            
                        $data .= "</tr>\n";
                        $mpdf->WriteHTML($data);
                        $data = "";

                    }//end while llenado de tabla
                    if($row_cnt != 0){
                        $mpdf->WriteHTML("</tbody>");
                        $mpdf->WriteHTML("</table> <br />");
                    }

                }//end if reservas antes de tabla
                else{
                    $mpdf->WriteHTML("No se obtubieron reservas");    
                }
                        
                
            //$mpdf->WriteHTML("Continuar siguiente tour");


            }//end while tours
             
        }//end if consulta tours y horarios

        /* cerrar la conexión */
        $mysqli->close();
        //$mpdf->WriteHTML("</tbody>");
        //$mpdf->WriteHTML("</table>");

        $mpdf->Output(); 
        exit;
?>