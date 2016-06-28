<?php

$pdf = Yii::createComponent('application.extensions.MPDF.mpdf');

//$model = new FACORDENCOMPR();

$Coc = $model->COD_ORDE;
$cliente = $model->COD_CLIE;
$Tienda = $model->COD_TIEN;
$oc = $model->NUM_ORDE;
$FecIng = $model->FEC_INGR;
$FecEnv = $model->FEC_ENVI;
$Est = $model->IND_ESTA;

$NewFecIng = date("d-m-Y", strtotime($FecIng));
$NewFecEnv = date("d-m-Y", strtotime($FecEnv));

function Estado($data) {

    switch ($data) {
        case 0:
            return 'Creado';
            break;
        case 1:
            return 'En Proceso';
            break;
        case 2:
            return 'Despacho/Atendido';
            break;
        case 9:
            return 'Anulado';
            break;
    }
}

$connection = Yii::app()->db;

$sqlStatement = "SELECT C.DES_CLIE, T.DES_TIEN,C.NRO_RUC FROM MAE_TIEND T
                     inner join MAE_CLIEN C on C.COD_CLIE = T.COD_CLIE
                     where T.COD_TIEN = '" . $Tienda . "' and C.COD_CLIE = '" . $cliente . "' ;";
$command = $connection->createCommand($sqlStatement);
$reader = $command->query();
while ($row = $reader->read()) {

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
            <center><strong><h2>Panaderia Pasteria Alemana</h2></strong></center>
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
        <th width="50%" >Señor(es): ' . $row['DES_CLIE'] . ' - ' . $row['DES_TIEN'] . '</th>
        <th width="25%" >RUC: ' . $row['NRO_RUC'] . ' </th>
        <th width="25%" >N° O/C: ' . $oc . ' </th>
     </tr>
</table>

<table border="0" class="table">
     <tr>
        <th width="33.33333333333333%" >Fecha Ingreso: ' . $NewFecIng . '</th>
        <th width="33.33333333333333%" >Fecha Envio: ' . $NewFecEnv . ' </th>
        <th width="33.33333333333333%" >Estado: ' . Estado($Est) . ' </th>
     </tr>
</table>';
}
?>

<?php

$sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.NRO_UNID,F.VAL_PREC,F.VAL_MONT_UNID,M.VAL_PESO,M.COD_MEDI  FROM FAC_DETAL_ORDEN_COMPR F
            inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
            where F.COD_CLIE = '" . $model->COD_CLIE . "' and F.COD_TIEN = '" . $model->COD_TIEN . "' and F.COD_ORDE = '" . $model->COD_ORDE . "';";
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
        <td style="text-align: center;" width="10%" > ' . $row['COD_PROD'] . ' </td>
        <td style="text-align: rigth;"  width="70%">' . $row['DES_LARG'] . ' ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['NRO_UNID'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['VAL_PREC'] . ' </td>
        </tr>

        ';
}
$htmlCU.='</table>'
?>
<?php

$htmlDE = '
        <table border="0" class="table table-condensed" >
     <tr>
        <th width="10%" ></th>
        <th width="60%" ></th>
        <th width="15%" >Sub Total</th>
        <th width="15%" style="text-align: right; ">' . $model->TOT_MONT_ORDE . '</th>
     </tr>
          <tr>
        <th width="10%" ></th>
        <th width="60%" ></th>
        <th width="15%" >I.G.V 18%</th>
        <th width="15%" style="text-align: right;">' . $model->TOT_MONT_IGV . '</th>
     </tr>
          <tr>
        <th width="10%" ></th>
        <th width="60%" ></th>
        <th width="15%" >Total</th>
        <th width="15%" style="text-align: right;">' . $model->TOT_FACT . '</th>
     </tr>
</table>
';
?>


<?php

$mpdf = new mPDF('A4');
$mpdf->WriteHTML($htmlCA); //Cabezera
$mpdf->WriteHTML($htmlCU);  //Cuerpo
$mpdf->WriteHTML($htmlDE);
$mpdf->Output('xxx.pdf','I');
exit;
//<table border="1" class="table">
//     <tr>
//        <th width="25%" >Codigo</th>
//        <th width="25%" >Descripción</th>
//        <th width="25%" >Cantidad</th>
//        <th width="25%" >Precio</th>
//     </tr>
//</table>