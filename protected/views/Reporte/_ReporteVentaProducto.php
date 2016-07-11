<?php

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
            <center><strong><h3>Top Venta de Productos</h3></strong></center>
            <br>
        </td>        
    </tr>
</table>
        Cliente: ' . $Cod_Clie . ' &nbsp; Tienda: ' . $Cod_Tiend . ' &nbsp; Estado: '.$Estado.'<br> 
        Del : '.$Fecha_Ini.' &nbsp; Hasta:  '.$Fecha_Fin.' 
    <br><br>
        
';

$htmlCU.='
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center;">Codigo</th>
    <th style="text-align: center;">Descripción</th>
    <th style="text-align: center;">Cantidad</th>
    <th style="text-align: center;">Precio</th>
    </tr>    
';

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

$mpdf = new mPDF('A4');
$mpdf->SetTitle("Top Venta de  Productos");
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