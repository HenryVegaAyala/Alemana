<div class="table-responsive container-fluid">

    <?php
    $UDP = Yii::app()->session['XXX'];

//        $UDP = "0";

    echo "Nombre de usuario recuperado de la variable de sesión:" . $UDP;

    function valor($COD) {
        if ($COD >= 0) {
            
            if($COD) {
                $connection = Yii::app()->db;
                $sqlStatement = "select COD_PROD, DES_LARG, NRO_UNID, VAL_PREC,VAL_MONT_UNID from TEMP_FAC_DETAL_ORDEN_COMPR where N_ORDEN = " . $COD;
                $command = $connection->createCommand($sqlStatement);
                $reader = $command->query();

                while ($resu = $reader->read()) {
                    echo '<tr>';
                    echo '<td>' . $resu['COD_PROD'] . '</td>';
                    echo '<td>' . $resu['DES_LARG'] . '</td>';
                    echo '<td>' . $resu['NRO_UNID'] . '</td>';
                    echo '<td>' . $resu['VAL_PREC'] . '</td>';
                    echo '<td>' . $resu['VAL_MONT_UNID'] . '</td>';
                    echo '</tr>';
                }
            }else{
                echo "no hay";
            }
        } else {
            echo "no hay";
        }
    }
    ?>

    <?php
    echo '<table>';
    echo '<tr>';
    echo '<th>Codigo Producto</th>';
    echo '<th>Descripción</th>';
    echo '<th>Cantidad</th>';
    echo '<th>Precio</th>';
    echo '<th>Total</th>';
    echo '</tr>';
    echo '<tbody>';

    valor($UDP);
    ?>
</div>