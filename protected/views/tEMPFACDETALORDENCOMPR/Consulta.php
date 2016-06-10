<head>
    <script>
        setInterval(function() {
            $("#div1").load(location.href + " #div1>*", "");
        }, 5000);</script>
</head>

<div class="div1 container-fluid" id="div1" >
    <?php
    
    $UDP = Yii::app()->session['USU'];

    $UDP2 = Yii::app()->session['PCIP'];

//    echo $UDP;
//    
//    echo "Nombre de usuario recuperado de la variable de sesión:" . $UDP . ' - ' . $UDP2;

    function valor($COD) {

        $UDP2 = Yii::app()->session['PCIP'];

        if ($COD !== '@') {

            if ($COD) {
                $connection = Yii::app()->db;
                $sqlStatement = "CALL Detalle_OC('" . $COD . "', '" . $UDP2 . "');";
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
            } else {
                echo "No se encuentra valores disponibles";
            }
        }
    }
    ?>

    <?php
    echo '<table class="table table-hover table-bordered table-condensed table-striped">';
    echo '<tr>';
    echo '<th style="text-align: center;" class="col-md-2">Codigo Producto</th>';
    echo '<th style="text-align: center;" >Descripción</th>';
    echo '<th style="text-align: center;" class="col-md-1">Cantidad</th>';
    echo '<th style="text-align: center;" class="col-md-1">Precio</th>';
    echo '<th style="text-align: center;" class="col-md-1">Total</th>';
    echo '</tr>';
    echo '<tbody>';

    valor($UDP);
    ?>
</div>