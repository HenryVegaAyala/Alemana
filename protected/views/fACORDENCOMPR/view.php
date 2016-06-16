<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs = array(
    'Facordencomprs' => array('index'),
    $model->COD_ORDE,
);
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Vista Detallada del O/C: <?php echo $model->NUM_ORDE; ?></h3>
        </div>

        <?php
        $this->widget('ext.bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'type' => 'bordered condensed striped raw',
            'attributes' => array(
                'COD_CLIE',
                'COD_TIEN',
                'NUM_ORDE',
                'TIP_MONE',
                'TOT_MONT_ORDE',
                'TOT_MONT_IGV',
                'TOT_FACT',
                'IND_ESTA',
                'FEC_INGR',
                'FEC_ENVI',
            ),
        ));
        ?>
