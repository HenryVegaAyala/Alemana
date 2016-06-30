<?php

$mpdf = Yii::createComponent('application.extensions.MPDF.mpdf');

//$model->fACGUIAREMIS;

$html = '
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
            <center><strong><h2>Panaderia Pasteria Alemana</h2></strong></center>
            <br>
            <center>Calle Ayabaca N° 173 Urb. Prolongación Benavides</center>
            <center>Lima - Lima - Santiago de Surco</center>
            <center>Telf: 733-0476 / 282-3595</center>
            <center>www.panaderiaalemana.com</center>
        </td>        
    </tr>
</table>';

$mpdf = new mPDF('utf-8', array(215, 215), 11, 'Arial', 12, 12, 12, 12, 'L');

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================
?>