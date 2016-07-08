<?php

set_time_limit(900);

$connection = Yii::app()->db;
$sqlStatement = "SELECT COD_FACT,
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
 AND M.COD_ORDE= Z.COD_ORDE
 ;";

$command = $connection->createCommand($sqlStatement);
$reader = $command->query();

ob_start();
echo "<table border=\"1\" align=\"center\">";
echo "<tr bgcolor=\"#FFE699\">
  <td align=\"center\"><font color=\"#000000\"><strong>N&#176 de Factura</strong></font></td>
  <td align=\"center\"><font color=\"#000000\"><strong>Cliente</strong></font></td>
  <td align=\"center\"><font color=\"#000000\"><strong>Fecha Facturada/Celular</strong></font></td>
  <td align=\"center\"><font color=\"#000000\"><strong>Fecha de Pago</strong></font></td>
  <td align=\"center\"><font color=\"#000000\"><strong>Estado</strong></font></td>
  <td align=\"center\"><font color=\"#000000\"><strong>N&#176 de Guia Documento</strong></font></td>
  <td align=\"center\"><font color=\"#000000\"><strong>N&#176 de O/C</strong></font></td>
  <td align=\"center\"><font color=\"#000000\"><strong>Total</strong></font></td>
</tr>";

$count = count($command);

while ($row = $reader->read()) {

    echo "<tr>";
    for ($j = 0; $j < $count; $j++) {
        echo "<td align=\"left\">" . $row[$j] . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
$reporte = ob_get_clean();
header("Content-type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=Facturas-" . date('d-m-Y') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $reporte;
?>