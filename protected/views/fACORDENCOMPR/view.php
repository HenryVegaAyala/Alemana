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
                'FEC_INGR',
                'FEC_ENVI',
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
</div>