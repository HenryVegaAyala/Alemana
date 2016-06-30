<?php

$mpdf = Yii::createComponent('application.extensions.MPDF.mpdf');

//$model->fACGUIAREMIS;

$html = '
    <link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/bootstrap/bootstrap.css" />
   
<style>
        img{
            width: 140px;
           }
        hr{
           color: #373737;
            background-color: #373737;
            height: 5px;
            margin-top: .1em;
           }
        td{
           border-radius: 15px;
           }
</style>
     
<table border="0" class="table">
    <tr>

    <td style="border: solid white" width="10%"> 
        <center>
                <img style="float:left;" src="' . Yii:: app()->request->baseUrl . '/images/logo.png">
        </center>
    </td> 
        
    <td style="border: solid white; border-width:1px 0;" width="50%">
            <center><h3><strong>Panaderia Alemana S.A.C </strong></h3></center>
            <br>
            <p>
            Calle Ayabaca N° 173            <br> 
            Urb. Prolongación Benavides     <br>
            Lima - Lima - Santiago de Surco <br>
            Telf: 733-0476 / 282-3595       <br>
            www.panaderiaalemana.com
            </p>
    </td>  
        
        <td style="border-radius: 15px;border: solid black;" width="40%" >
            <center><strong><h2>R.U.C. 20536040995</h2></strong></center>
            <br>
            <p>
            <h4>
            GUÍA DE REMISION - REMITENTE<br> 
            </h4>
            </p>
            <br>
            <p>
            <h4>
            0001 - N° <br> 
            </h4>
            </p>
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