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

//$FEC_INI = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha_Ini));
//$FEC_FIN = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha_Fin));

function imprimir($id,$tota){
	$connection = Yii::app()->db;
	$Usuario = Yii::app()->user->name;
	$sqlStatement3 = "SELECT * FROM tmp_repor_venta where cod_clie = $id and USU_DIGI='$Usuario';";
	$command3 = $connection->createCommand($sqlStatement3);
	$reader3 = $command3->query();
	$cadena='';
	while ($row = $reader3->read()) {
		$cadena.= '
            <tr>
            <td style="text-align: center;" width="25%" > ' . $row['DES_CLIE'] . ' </td>
            <td style="text-align: rigth;"  width="25%">' . $row['DIR_TIEN'] . '</td>
            <td style="text-align: center;" width="25%"> ' . $row['IMP_TOTA'] . ' </td>
            </tr>';
	}
	
	$cadena.= '
            <tr>
            <td style="text-align: center;" width="25%"></td>
			<td style="text-align: center;" width="25%">TOTAL</td>
			<td style="text-align: center;" width="25%"></td>
            <td style="text-align: letf;"  width="25%">' . $tota . ' </td>
              </tr>';
	
	return $cadena;
}

function imprimirProducto($id,$tota){
	$connection = Yii::app()->db;
	$Usuario = Yii::app()->user->name;
	$sqlStatement3 = "SELECT * FROM tmp_repor_venta where cod_clie = $id and usu_digi='$Usuario';";
	$command3 = $connection->createCommand($sqlStatement3);
	$reader3 = $command3->query();
	$cadena='';
	while ($row = $reader3->read()) {
		$cadena.= '
        <tr>
        <td style="text-align: center;" width="12%"> ' . $row['DES_CLIE'] . ' </td>
        <td style="text-align: center;"  width="12%">' . $row['DIR_TIEN'] . '</td>
        <td style="text-align: left;"  width="16%">' . $row['COD_PROD'] . '</td>
        <td style="text-align: left;"  width="40%">' . $row['DES_LARG'] . '</td>
        <td style="text-align: right;" width="10%"> ' . number_format($row['UNI_SOLI'],2) . ' </td>
        <td style="text-align: right;" width="10%"> ' . $row['IMP_TOTA'] . ' </td>
        </tr>';
	}

	$cadena.= '
            <tr>
			 <td style="text-align: center;" width="25%"></td>
			 <td style="text-align: center;" width="25%"></td>
            <td style="text-align: center;" width="25%"></td>
			<td style="text-align: center;" width="25%">TOTAL</td>
			<td style="text-align: center;" width="25%"></td>
            <td style="text-align: center;"  width="25%">' . $tota . ' </td>
              </tr>';

	return $cadena;
}
        
function Cuerpo($id) {

    $connection = Yii::app()->db;
    $Usuario = Yii::app()->user->name;
    $sqlStatement = "SELECT * FROM tmp_repor_venta t where usu_digi='$Usuario' order by COD_CLIE,imp_tota desc;";
    $command = $connection->createCommand($sqlStatement);
    $total=0.00;
    $reader = $command->query();

    $Cliente.='
        
    <table border="1" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center;">CLIENTE</th>
     <th style="text-align: center;">VENTA</th>
    </tr>    
';
    while ($row = $reader->read()) {
//
//        $n = 3;
//        rowspan='.$n.'
        $total= $total +  $row['IMP_TOTA'] ;
        $Cliente.= '
        <tr>
         <td style="text-align: left;" width="25%" > ' . $row['DES_CLIE'] . ' </td>
         <td style="text-align: center;" width="25%"> ' . $row['IMP_TOTA'] . ' </td>
        </tr>

        ';
    }
    $Cliente.='</table>';
    
    
     $Cliente.='<table border="0" >
            <tr>
               <td width="5%" ></td>
               <td width="25%" ></td>
               <td width="28%" ></td>
               <td width="25%" ></td>
               <td width="20%" ></td>
               <td width="20%" ></td>
                <td width="20%"></td>
                <td width="25%"  style="text-align: center;" >TOTAL</td>                
                <td width="25%"  style="text-align: left;">'. number_format($total,2) .'</td>
            </tr>
       
        </table>';

    $reader = $command->query();
    $Tienda.='
        
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center;">CLIENTE</th>
    <th style="text-align: center;">TIENDA</th>
 
    <th style="text-align: center;">VENTA</th>
    </tr>    
';
    
    $sqlStatement1 = "SELECT COD_CLIE, SUM(IMP_TOTA) Total FROM tmp_repor_venta where usu_digi='$Usuario' GROUP BY COD_CLIE order by 2 desc;";
    $command1 = $connection->createCommand($sqlStatement1);
    $totaL=0.00;
    $reader2 = $command1->query();
    while ($row2 = $reader2->read()) {
    	$clie = $row2['COD_CLIE'];
    	$tot= $row2['Total'];
    	$totaL=$totaL+$tot;
    	$Tienda.=imprimir($clie,$tot);
    }
    
   

    $Tienda.='</table>';
    
     $Tienda.='<table border="0" >
            <tr>
                <td width="25%" ></td>
     		<td width="25%" ></td>
     		<td width="25%" ></td>
     		<td width="25%" ></td>
     		
     		
                <td width="25%" ></td>
                <td width="25%"  style="text-align: center;" >TOTAL</td>                
                <td width="25%"  style="text-align: left;">'. number_format($totaL,2) .'</td>
            </tr>
       
        </table>';

    $reader = $command->query();
    $Producto.='
        
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center;">CLIENTE</th>
    <th style="text-align: center;">TIENDA</th>
    <th style="text-align: center;">CODIGO</th>
    <th style="text-align: center;">PRODUCTO</th>
    <th style="text-align: center;">UNIDADES</th>
    <th style="text-align: center;">TOTAL</th>
    </tr>    
';
    
    
    $sqlStatement1 = "SELECT COD_CLIE, SUM(IMP_TOTA) Total FROM tmp_repor_venta where usu_digi='$Usuario' GROUP BY COD_CLIE order by 2 desc;";
    $command1 = $connection->createCommand($sqlStatement1);
    $totaL=0.00;
    $reader2 = $command1->query();
    while ($row2 = $reader2->read()) {
    	$clie = $row2['COD_CLIE'];
    	$tot= $row2['Total'];
    	$totaL=$totaL+$tot;
    	$Producto.=imprimirProducto($clie,$tot);
    }
    
  
    $Producto.='</table>';
    
    $Producto.='<table border="0" >
            <tr>
                <td width="25%" ></td>
     		<td width="25%" ></td>
     		<td width="25%" ></td>
     		<td width="25%" ></td>
    
    
                <td width="25%" ></td>
                <td width="25%"  style="text-align: center;" >TOTAL</td>
                <td width="25%"  style="text-align: left;">'. number_format($totaL,2) .'</td>
            </tr>
    
        </table>';
    

    switch ($id) {
        case 0:
            return $Cliente;
            break;
        case 1:
            return $Tienda;
            break;
        case 2:
            return $Producto;
            break;
    }
}

$mpdf = Yii::createComponent('application.extensions.MPDF.mpdf');

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
            <center><strong><h3>Resumen Venta ' . TopVenta($Agrupa) . '</h3></strong></center>
            <br>
        </td>        
    </tr>
</table>
        Fecha de : ' . $Fecha_Ini . ' &nbsp; Hasta:  ' . $Fecha_Fin . ' 
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            
            Usuario Solicitado : ' . $Usuario . '    
    <br><br>
        
';

/* ----------------------------------------------------------------------------------------------------------------- */

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
$mpdf = new mPDF('utf-8', 'A4-L');
//$mpdf = new mPDF($mode, $format, $default_font_size, $default_font, $mgl, $mgr, $mgt, $mgb, $mgh, $mgf);

$mpdf->SetTitle("Resumen de Venta " . TopVenta($Agrupa) . "");
$mpdf->SetAuthor("PANADERIA ALEMANA");
$mpdf->WriteHTML($htmlCA); //Cabezera
$mpdf->WriteHTML(Cuerpo($Agrupa));  //Cuerpo
$mpdf->WriteHTML($htmlDE);
$mpdf->Output($Reporte, 'I');
exit;