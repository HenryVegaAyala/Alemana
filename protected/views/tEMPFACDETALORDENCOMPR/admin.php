<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'tempfacdetalordencompr-grid',
    'dataProvider' => $model->search(),
//    'filter' => $model,
    'columns' => array(
//        'COD_ORDE',
        'COD_PROD',
        'NRO_UNID',
        'VAL_PREC',
        'VAL_MONT_UNID',
        'VAL_MONT_IGV',
        'VAL_TOTAL',
//        'DES_PROD',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
