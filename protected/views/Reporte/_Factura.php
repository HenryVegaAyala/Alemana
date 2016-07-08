<?php

Yii::import("ext.PHPExcel.XPHPExcel");
$objPHPExcel = XPHPExcel::createPHPExcel();

set_time_limit(900);

$objPHPExcel->getProperties()->setCreator("Arunsri")
        ->setLastModifiedBy("Arunsri")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'N° de Factura')
        ->setCellValue('B1', 'Cliente')
        ->setCellValue('C1', 'Fecha Facturada')
        ->setCellValue('D1', 'Fecha de Pago')
        ->setCellValue('E1', 'Estado')
        ->setCellValue('F1', 'N° de Guia Documento')
        ->setCellValue('G1', 'N° de O/C')
        ->setCellValue('H1', 'Total');

$sql = "SELECT COD_FACT,
 (SELECT DES_CLIE FROM MAE_CLIEN Z WHERE Z.COD_CLIE= Y.COD_CLIE) CLIENTE,
 FEC_FACT,
 Y.FEC_PAGO,
 CASE  Y.IND_ESTA
    WHEN Y.IND_ESTA='1' THEN 'PENDIENTE PAGO'
    WHEN Y.IND_ESTA='2' THEN 'COBRADO'
    WHEN Y.IND_ESTA='9' THEN 'ANULADO'
   END AS  ESTADO,
  Z.COD_GUIA,
  M.NUM_ORDE,
  Y.TOT_FACT
FROM fac_factu Y,fac_guia_remis Z,fac_orden_compr M
WHERE Y.COD_GUIA= Z.COD_GUIA
 AND M.COD_ORDE= Z.COD_ORDE;";
$datas = Yii::app()->db->createCommand($sql)->queryAll();

for ($i = 0; $i < count($datas); $i++) {
    $j = $i + 2;
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $j, $datas[$i]['COD_FACT'])
            ->setCellValue('B' . $j, $datas[$i]['CLIENTE'])
            ->setCellValue('C' . $j, $datas[$i]['FEC_FACT'])
            ->setCellValue('D' . $j, $datas[$i]['FEC_PAGO'])
            ->setCellValue('E' . $j, $datas[$i]['ESTADO'])
            ->setCellValue('F' . $j, $datas[$i]['COD_GUIA'])
            ->setCellValue('G' . $j, $datas[$i]['NUM_ORDE'])
            ->setCellValue('H' . $j, $datas[$i]['TOT_FACT']);
}

$styleArray = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => '#000000'),
        'name' => 'Arial'
    ),
    
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),

);

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);

// uncomment the following to include image in sheet 2
/*
  // Create new sheet in current excel file
  $objPHPExcel->createSheet(1);
  $objPHPExcel->setActiveSheetIndex(1);
  $objPHPExcel->getSheet(1)->setTitle('Image');

  //To Insert an image in excelsheet
  $objDrawingPType = new PHPExcel_Worksheet_Drawing();
  $objDrawingPType->setWorksheet($objPHPExcel->setActiveSheetIndex(1));
  $objDrawingPType->setName("Pareto By Type");
  $objDrawingPType->setPath(Yii::app()->basePath . DIRECTORY_SEPARATOR . "../images/logo.png");
  $objDrawingPType->setCoordinates('B2');
  $objDrawingPType->setOffsetX(1);
  $objDrawingPType->setOffsetY(5);
 */

// Rename worksheet
$objPHPExcel->getSheet(0)->setTitle("Facturas-" . date('d-m-Y'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a clientâ€™s web browser (Excel5)
$reporte = ob_get_clean();
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=Facturas-" . date('d-m-Y') . ".xls");
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');


// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
Yii::app()->end();
echo $reporte;
