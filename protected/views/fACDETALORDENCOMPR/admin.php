<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    /*
      'COD_CLIE',
      'COD_TIEN',
      'COD_ORDE',
      'COD_PROD',
      'NRO_UNID',
      'VAL_PREC',

      'VAL_IGV',
      'VAL_MONT_UNID',
      'VAL_MONT_IGV',
      'USU_DIGI',
      'FEC_DIGI',
      'USU_MODI',
      'FEC_MODI',
     */

    'type' => 'striped bordered condensed',
    'id' => 'facdetalordencompr-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(

            'header' => 'Codigo',
            'value' => '$data->COD_PROD'),
        array(

            'header' => 'Descripción',
            'value' => '$data->cODPROD->DES_LARG'),
        array(

            'header' => 'Cantidad',
            'value' => '$data->NRO_UNID'),
        array(

            'header' => 'Precio',
            'value' => '$data->VAL_PREC'),
        array(

            'header' => 'Total',
            'value' => '$data->VAL_TOTAL'),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Quitar',
//            'deleteButtonUrl' => 'Yii::app()->createUrl("TempProducto/delete",array("id"=>$data["n_presu"]))',
            'template' => '{delete}',
        )
    ),
));
?>