<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */

$this->breadcrumbs = array(
    'Productos',
);
?>

<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'maeprodu-grid',
    'type' => 'bordered condensed striped',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'COD_PROD',
        'DES_LARG',
        array(
            'header' => 'Linea',
            'value' => '$data->cODLINE->DES_LARG',
            'htmlOptions'=>array('style'=>'word-wrap:break-word; width:300px; table-layout:fixed; '),
        ),
        array(
            'header' => 'Opción',
            'class' => 'ext.bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px; text-align: center;'),
//            'template' => '{view}{update}{delete}{migrar}',
            'template' => '{update}{migrar}',
            'buttons' => array(
                'migrar' => array(
                    'icon' => 'CHECK',
                    'htmlOptions' => array('style' => 'width: 50px'),
                    'url' => 'Yii::app()->controller->createUrl("/Presupuesto/migrar", array("id"=>$data->COD_PROD))',
                ),
            ),
        ),
    ),
));
?>
<br>