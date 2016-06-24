<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */

$this->breadcrumbs = array(
    'Detalle Guia' => array('index'),
);
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <center>
                <h3 class="panel-title">Vista Detallada del N° de Guia: <big><strong><?php echo $model->COD_GUIA; ?></strong></big></h3>
            </center>
        </div>
        <?php
        $estado = "";
        switch ($model->IND_ESTA) {
            case '1':
                $estado = 'Emitida / Pendiente de cobro';
                break;
            case '2':
                $estado = 'Cobrada / Cerrada';
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
        $FEC_INGRE = Yii::app()->dateFormatter->format("dd/MMMM/y", strtotime($model->FEC_EMIS));

        $FEC_ENVI = Yii::app()->dateFormatter->format("dd/MMMM/y", strtotime($model->FEC_TRAS));
        ?>

        <?php
        $this->widget('ext.bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'type' => 'bordered condensed striped raw',
            'attributes' => array(
                'COD_ORDE',
                'COD_TIEN',
                'COD_CLIE',
                array(
                    'name' => 'FEC_EMIS',
                    'header' => 'Fecha de Ingreso',
                    'value' => $FEC_INGRE,
                ),
                array(
                    'name' => 'FEC_TRAS',
                    'header' => 'Fecha de Envio',
                    'value' => $FEC_ENVI,
                ),
                array(
                    'name' => 'Estado',
                    'value' => $estado),
            ),
        ));
        ?>
