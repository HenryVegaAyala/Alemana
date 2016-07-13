<?php

function TopVenta($id) {
    switch ($id) {
        case 0:
            return 'por Cliente';
            break;
        case 1:
            return 'por Tienda';
            break;
        case 2:
            return 'por Producto';
            break;
    }
}

$FECFACT = date("dmY");
$Reporte = "ResumenDeVenta-$FECFACT.pdf";

$FEC_INI = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha_Ini));
$FEC_FIN = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha_Fin));

$pdf = Yii::createComponent('application.extensions.MPDF.mpdf');

$htmlCA = '
<html>

    <link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/bootstrap/bootstrap.css" />

<style>
        img{
            width: 120px;
           }
        hr{
           color: #373737;
            background-color: #373737;
            height: 5px;
            margin-top: .1em;
           }
</style>
     
<table border="0" class="table">
    <tr>
        <td>
            <center>
                <img style="float:left;" src="' . Yii:: app()->request->baseUrl . '/images/logo.png">
            </center>
        </td>
        
        <td>
            <center><strong><h2>PANADERIA PASTELERIA ALEMANA</h2></strong></center>
            <br>
            <center>Calle Ayabaca N° 173 Urb. Prolongación Benavides</center>
            <center>Lima - Lima - Santiago de Surco</center>
            <center>Telf: 733-0476 / 282-3595</center>
            <center>www.panaderiaalemana.com</center>
        </td>        
    </tr>
</table>

<div class="hr"><hr /></div>

<table border="0" class="table">
    <tr>
        <td>
            <center><strong><h3>Resumen Venta '.  TopVenta($Agrupa).'</h3></strong></center>
            <br>
        </td>        
    </tr>
</table>
        Fecha de : ' . $FEC_INI . ' &nbsp; Hasta:  ' . $FEC_FIN . ' 
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            
            Usuario Solicitado : ' . $Usuario . '    
    <br><br>
        
';

$connection = Yii::app()->db;
$sqlStatement = "SELECT * FROM tmp_repor_venta t;";
$command = $connection->createCommand($sqlStatement);
$reader = $command->query();

$htmlCU.='
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center;">Codigo</th>
    <th style="text-align: center;">Descripción</th>
    <th style="text-align: center;">Cantidad</th>
    <th style="text-align: center;">Precio</th>
    </tr>    
';
while ($row = $reader->read()) {

    $htmlCU.= '
       
        <tr>
        <td style="text-align: center;" width="10%" > ' . $row['COD_CLIE'] . ' </td>
        <td style="text-align: rigth;"  width="70%">' . $row['DIR_TIEN'] . ' ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['COD_TIEN'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['UNI_SOLI'] . ' </td>
        </tr>

        ';
}
$htmlCU.='</table>';

$htmlDE = '

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Pag. {PAGENO} / {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />

';
?>


<?php

//$mpdf = new mPDF('utf-8', array(105, 148), 11, 'Arial', 12, 12, 12, 12, 'L');
$mpdf = new mPDF('utf-8','A4-L');
//$mpdf = new mPDF($mode, $format, $default_font_size, $default_font, $mgl, $mgr, $mgt, $mgb, $mgh, $mgf);

$mpdf->SetTitle("Resumen de Venta ".TopVenta($Agrupa)."");
$mpdf->SetAuthor("PANADERIA ALEMANA");
//$mpdf->SetWatermarkText("ORDEN DE COMPRA");
//$mpdf->showWatermarkText = true;
//$mpdf->watermark_font = 'DejaVuSansCondensed';
//$mpdf->watermarkTextAlpha = 0.1;
$mpdf->WriteHTML($htmlCA); //Cabezera
$mpdf->WriteHTML($htmlCU);  //Cuerpo
$mpdf->WriteHTML($htmlDE);
$mpdf->Output($Reporte, 'I');
exit;