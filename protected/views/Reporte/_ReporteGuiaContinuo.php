<?php

$count = count($idguia);

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
        $sqlStatement = "SELECT COD_GUIA,FEC_TRAS,DIR_TIEN,DES_CLIE,NRO_RUC FROM FAC_GUIA_REMIS F
                            inner join MAE_CLIEN C on F.COD_CLIE = C.COD_CLIE
                            inner join MAE_TIEND T on F.COD_TIEN = T.COD_TIEN
                            where COD_GUIA = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        while ($row = $reader->read()) {
            $idguia = $row['COD_GUIA'];
            $Fecha = $row['FEC_TRAS'];
            $Ruc = $row['NRO_RUC'];
            $Descli = $row['DES_CLIE'];
            $DirTien = $row['DIR_TIEN'];
        }

        $Fecha_Fac = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha));

        $this->SetFont('Arial', '', 9);
        $this->Ln();
        $this->Cell(18, 3, '', 0);
        $this->Ln();
        $this->Cell(9, 0.5, '', 0, '', 'C');
        $this->Cell(9, 0.5, utf8_decode(strtoupper($idguia)), 0, '', 'C');
        $this->Ln();
        $this->Cell(2, 1, '', 0);
        $this->Cell(16, 0.6, utf8_decode(strtoupper($Fecha_Fac)), 0);
        $this->Ln();
        $this->Cell(2, 1, '', 0);
        $this->Cell(9, 0.6, utf8_decode(strtoupper($Descli)), 0);
        $this->Cell(2, 1, '', 0);
        $this->Cell(5, 0.6, strtoupper('CALLE AYABACA 173'), 0, '', 'R');
        $this->Ln();
        $this->Cell(2, 1, '', 0);
        $this->Cell(9, 0.6, utf8_decode(strtoupper($Ruc)), 0);
        $this->Cell(2, 1, '', 0);
        $this->Cell(5, 0.6, strtoupper($DirTien), 0, '', 'R');
        $this->Ln();

//        $this->Cell(Ancho , Alto , cadena , bordes , posición , alinear , fondo, URL )
    }

    function Cuerpo($i) {
        $connection = Yii::app()->db;
        $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,M.VAL_PESO,M.COD_MEDI  FROM fac_detal_guia_remis F
                        inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
                        where COD_GUIA = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        while ($row = $reader->read()) {
            
            $unid = $row['UNI_SOLI'];
            $product = strtoupper($row['DES_LARG']);
            $medidas =  ($row['VAL_PESO'] . ' ' . $row['COD_MEDI']);
            $val = $row['VAL_PROD'];
            $precTo = $row['IMP_PROD'];

            $this->SetFont('Arial', '', 9);
            $this->Ln();
            $this->Cell(2, 0.5, number_format($unid), 0, '', 'L');
            $this->Cell(10, 0.5, utf8_decode(strtoupper($product)), 0);
            $this->Cell(2, 0.5, utf8_decode($medidas), 0, '', 'C');
            $this->Cell(2, 0.5, strtoupper($val), 0, '', 'C');
            $this->Cell(2, 0.5, strtoupper($precTo), 0, '', 'R');
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
        $this->SetXY(1.8, 17);
        $this->Cell(2, 0.5, '', 0, '', 'C');
        $this->Cell(16, 0.5, utf8_decode(strtoupper(numtoletras($Total))), 0);
        $this->Ln();
        $this->Cell(12, 1, '', 0, '', 'C');
        $this->Cell(2, 1, strtoupper($Stotal), 0, '', 'C');
        $this->Cell(2, 1, strtoupper($IGVPRO), 0, '', 'C');
        $this->Cell(2, 1, strtoupper($Total), 0, '', 'C');
    }

    function Impresion($i) {

        $this->Cabecera($i);
        $this->Cuerpo($i);
//        $this->Detalle($i);
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

$pdf = new PDF('P', 'cm', 'A4');
$pdf->SetMargins(1.8, 0.8, 1.8);
for ($i = 0; $i < $count; $i++) {

    if ($i <> ($count))
        $pdf->AddPage(); //añades mientras no seas ultima pagina

    $pdf->Impresion($idguia[$i]);

    $pdf->SetTitle("REPORTE FACTURA MASIVO");
    $pdf->SetAuthor("PANADERIA ALEMANA");
}
$pdf->AutoPrint(true);
$FECFACT = date("dmY");
$Reporte = "Factura_Masiva_$FECFACT.pdf";

$pdf->Output($Reporte, 'I');
