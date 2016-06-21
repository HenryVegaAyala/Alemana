<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs = array(
    'Detalle O/C' => array('index'),
);
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <center>
                <h3 class="panel-title">Vista Detallada del N° de orden de la O/C: <big><strong><?php echo $model->NUM_ORDE; ?></strong></big></h3>
            </center>
        </div>

        <?php
        $moneda = "";
        switch ($model->TIP_MONE) {
            case '0':
                $moneda = 'PE – Nuevo Soles';
                break;
            case '1':
                $moneda = 'US –Dólares Americanos';
                break;
            default :
                $moneda = "";
        }

        $estado = "";
        switch ($model->IND_ESTA) {
            case '1':
                $estado = 'En Proceso';
                break;
            case '2':
                $estado = 'Despachadado/Atendido';
                break;
            case '9':
                $estado = 'Anulado';
                break;
            case '0':
                $estado = 'Creado';
                break;
            default :
                $estado = "";
        }

        $cli = $model->cODCLIE->COD_CLIE;

        $FEC_INGRE = Yii::app()->dateFormatter->format("dd/MMMM/y", strtotime($model->FEC_INGR));

        $FEC_ENVI = Yii::app()->dateFormatter->format("dd/MMMM/y", strtotime($model->FEC_ENVI));

        $this->widget('ext.bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'type' => 'bordered condensed striped raw',
            'attributes' => array(
                array(
                    'name' => 'Nombre del Cliente',
                    'value' => $model->getCliente($cli)),
                array(
                    'name' => 'Nombre de la Tienda',
                    'value' => $model->cODTIEN->DES_TIEN),
                array(
                    'name' => 'Tipo de Moneda',
                    'value' => $moneda),
                array(
                    'name' => 'FEC_INGR',
                    'header' => 'Fecha de Ingreso',
                    'value' => $FEC_INGRE,
                ),
                array(
                    'name' => 'FEC_ENVI',
                    'header' => 'Fecha de Envio',
                    'value' => $FEC_ENVI,
                ),
                array(
                    'name' => 'Estado',
                    'value' => $estado),
                'TOT_MONT_ORDE',
                'TOT_MONT_IGV',
                'TOT_FACT',
            ),
        ));
        ?>
    </div>

    <?php

    function valor($a, $b, $c) {

        $connection = Yii::app()->db;
        $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.NRO_UNID,F.VAL_PREC,F.VAL_MONT_UNID FROM FAC_DETAL_ORDEN_COMPR F
        inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
        where F.COD_CLIE = '" . $a . "' and F.COD_TIEN = '" . $b . "' and F.COD_ORDE = '" . $c . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();

        while ($resu = $reader->read()) {
            echo '<tr>';
            echo '<td>' . $resu['COD_PROD'] . '</td>';
            echo '<td>' . $resu['DES_LARG'] . '</td>';
            echo '<td>' . $resu['NRO_UNID'] . '</td>';
            echo '<td>' . $resu['VAL_PREC'] . '</td>';
            echo '</tr>';
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
    echo '</tr>';
    echo '<tbody>';

    valor($model->COD_CLIE, $model->COD_TIEN, $model->COD_ORDE);
    ?>

</div>
