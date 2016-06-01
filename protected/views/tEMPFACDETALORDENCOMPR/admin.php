<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'tempfacdetalordencompr-grid',
    'dataProvider' => $model->search(),
//    'filter' => $model,
    'columns' => array(
//        'COD_ORDE',
        'COD_PROD',
        'DES_LARG',
        'NRO_UNID',
        'VAL_PREC',
//        'VAL_MONT_UNID',
//        'VAL_MONT_IGV',
        'VAL_MONT_UNID',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Quitar',
            'deleteButtonUrl' => 'Yii::app()->createUrl("TEMPFACDETALORDENCOMPR/delete",array("id"=>$data["COD_ORDE"]))',
            'template' => '{delete}',
        )
    ),
));
?>
