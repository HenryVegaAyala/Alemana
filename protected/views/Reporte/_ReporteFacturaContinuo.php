<?php

$count = count($idfactu);

yii::import('application.extensions.fpdf.*');

class PDF_JavaScript extends FPDF {

    var $javascript;
    var $n_js;

    function IncludeJS($script) {
        $this->javascript = $script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js = $this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) ' . ($this->n + 1) . ' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS ' . $this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript ' . ($this->n_js) . ' 0 R>>');
        }
    }

}

class PDF extends PDF_JavaScript {

    function Cabecera($i) {

        $connection = Yii::app()->db;
        $sqlStatement = "SELECT COD_FACT, FEC_FACT,COD_GUIA,NRO_RUC,DES_CLIE,DIR_TIEN FROM FAC_FACTU M
                        inner join MAE_CLIEN C on C.COD_CLIE = M.COD_CLIE
                        inner join MAE_TIEND T on C.COD_CLIE = T.COD_CLIE
                        where COD_FACT  = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        while ($row = $reader->read()) {
            $Factura = $row['COD_FACT'];
            $Guia = $row['COD_GUIA'];
            $Fecha = $row['FEC_FACT'];
            $Ruc = $row['NRO_RUC'];
            $Descli = $row['DES_CLIE'];
            $DirTien = $row['DIR_TIEN'];
        }

        $Fecha_Fac = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha));

        $this->SetFont('Arial', '', 9);

//       -- Espacio 1
        $this->Cell(19.3, 3.8, '', 1);
        $this->Ln();
//       -- Espacio 2
        $this->Cell(11.8, 0.5, '', 1, '', 'C');
        $this->Cell(7.5, 0.5, utf8_decode(strtoupper($Factura)), 1, '', 'C');
        $this->Ln();
//       -- Espacio 3
        $this->Cell(19.3, 0.3, '', 1, '', 'C');
        $this->Ln();
//       -- Espacio 4        
        $this->Cell(2, 0.8, '', 1,'');
        $this->Cell(17.3, 0.8, utf8_decode(strtoupper($Fecha_Fac)), 1,'');
        $this->Ln();
//       -- Espacio 5
        $this->Cell(2, 0.8, '', 1,'');
        $this->Cell(10.3, 0.8, utf8_decode(strtoupper($Descli)), 1,'');
        $this->Cell(2, 0.8, '', 1,'');
        $this->Cell(5, 0.8, strtoupper($Ruc), 1, '', 'C');
        $this->Ln();
//       -- Espacio 6
        $this->Cell(2, 0.8, '', 1);
        $this->Cell(10.3, 0.8, utf8_decode(strtoupper($DirTien)), 1,'');
        $this->Cell(2, 0.8, '', 1);
        $this->Cell(5, 0.8, strtoupper($Guia), 1, '', 'C');
        $this->Ln();
//        $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
    }

    function Cuerpo($i) {
        $connection = Yii::app()->db;
        $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,F.IGV_PROD,F.IMP_TOTA_PROD,M.VAL_PESO,M.COD_MEDI,FF.TOT_FACT_SIN_IGV,FF.TOT_IGV,FF.TOT_FACT  FROM FAC_DETAL_FACTU F
        inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
        inner join FAC_FACTU FF on F.COD_FACT = FF.COD_FACT
        where F.COD_FACT = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        
//       -- Espacio 7
        $this->Cell(19.3, 1, '', 1,'');
        $this->Ln();
        
        while ($row = $reader->read()) {
            $unid = $row['UNI_SOLI'];
            $product = strtoupper($row['DES_LARG']) . ' ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'];
            $val = $row['VAL_PROD'];
            $precTo = $row['IMP_PROD'];

            $this->SetFont('Arial', '', 8);
//       -- Espacio N            
            $this->Cell(1.6, 0.4, number_format($unid), 1, '', 'L');
            $this->Cell(11.8, 0.4, utf8_decode(strtoupper($product)), 1,'');
            $this->Cell(2.9, 0.4, strtoupper($val), 1, '', 'C');
            $this->Cell(3, 0.4, strtoupper($precTo), 1, '', 'C');
            $this->Ln();
        }
    }

    function Detalle($i) {
        $connection = Yii::app()->db;
        $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,F.IGV_PROD,F.IMP_TOTA_PROD,M.VAL_PESO,M.COD_MEDI,FF.TOT_FACT_SIN_IGV,FF.TOT_IGV,FF.TOT_FACT  FROM FAC_DETAL_FACTU F
        inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
        inner join FAC_FACTU FF on F.COD_FACT = FF.COD_FACT
        where F.COD_FACT = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        while ($row = $reader->read()) {
            $Stotal = $row['TOT_FACT_SIN_IGV'];
            $IGVPRO = $row['TOT_IGV'];
            $Total = $row['TOT_FACT'];
        }
        $this->SetFont('Arial', '', 9);
        
        $this->SetXY(1.93, 17.09);
        
        $this->Ln();
        $this->Cell(19.3, 0.7, '', 1, '', 'C');
        $this->Ln();
        $this->Cell(1.2, 0.5, '', 1, '', 'C');
        $this->Cell(18.1, 0.5, utf8_decode(strtoupper(numtoletras($Total))), 1);
        $this->Ln();
        $this->Cell(9.6, 1.5, '', 1, '', 'C');
        $this->Cell(3.1, 1.5, strtoupper($Stotal), 1, '', 'C');
        $this->Cell(3.1, 1.5, strtoupper($IGVPRO), 1, '', 'C');
        $this->Cell(3.5, 1.5, strtoupper($Total), 1, '', 'C');
    }

    function Impresion($i) {

        $this->Cabecera($i);
        $this->Cuerpo($i);
        $this->Detalle($i);
    }

    function AutoPrint($dialog = false) {
        //Open the print dialog or start printing immediately on the standard printer
        $param = ($dialog ? 'true' : 'false');
        $script = "print($param);";
        $this->IncludeJS($script);
    }

    function AutoPrintToPrinter($server, $printer, $dialog = false) {
        //Print on a shared printer (requires at least Acrobat 6)
        $script = "var pp = getPrintParams();";
        if ($dialog)
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        else
            $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
        $script .= "pp.printerName = '\\\\\\\\" . $server . "\\\\" . $printer . "';";
        $script .= "print(pp);";
        $this->IncludeJS($script);
    }

}

function numtoletras($xcifra) {
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 1, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 1, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                        } else {
                            $key = (int) substr($xaux, 1, 3);
                            if (TRUE === array_key_exists($key, $xarray)) {  // busco si la centena es número redondo (101, 201, 301, 401, etc..)
                                $xseek = $xarray[$key];
                                $xsub = $this->subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 1, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 121, 981, etc.)
                                $key = (int) substr($xaux, 1, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 101,201,301, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CON $xdecimales/100 SOLES";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "CON  $xdecimales/100 SOL ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " CON $xdecimales/100 SOLES "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

function subfijo($xx) { // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

//$pdf = new PDF('L', 'cm', array(21.5, 21.7));
$pdf = new PDF('P', 'cm', 'A4');

$pdf->SetMargins(1.1, 0.8, 1.3);
$pdf->SetTopMargin(2.3);
//$pdf->SetMargins($left, $top, $right)
for ($i = 0; $i < $count; $i++) {

    if ($i <> ($count))
        $pdf->AddPage(); //añades mientras no seas ultima pagina

    $pdf->Impresion($idfactu[$i]);

    $pdf->SetTitle("REPORTE FACTURA MASIVO");
    $pdf->SetAuthor("PANADERIA ALEMANA");
}
//$pdf->AutoPrint(true);
$FECFACT = date("dmY");
$Reporte = "Factura_Masiva_$FECFACT.pdf";

$pdf->Output($Reporte, 'I');
