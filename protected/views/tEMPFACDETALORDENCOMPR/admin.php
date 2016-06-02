<div class="table-responsive">
    <?php
    $this->widget('ext.bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'itemsCssClass' => 'table-bordered items',
        'id' => 'tempfacdetalordencompr-grid',
        'dataProvider' => $model->search(),
//    'filter' => $model,
        'columns' => array(
//            array(
//                'id' => 'COD_ORDE',
//                'class' => 'CCheckBoxColumn',
//                'selectableRows' => '50',
//            ),
//        'COD_ORDE',
            'COD_PROD',
            'DES_LARG',
            'NRO_UNID',
//            array(
//                'name' => 'NRO_UNID',
//                'type' => 'raw',
//                'value' => 'CHtml::textField("NRO_UNID[$data->NRO_UNID]",$data->NRO_UNID,array("style"=>"width:50px;"))',
//                'htmlOptions' => array("width" => "50px"),
//            ),
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

    <script>
        function reloadGrid(data) {
            $.fn.yiiGridView.update('tempfacdetalordencompr-grid');
        }
    </script>

    <?php // echo CHtml::ajaxSubmitButton('Filter', array('TEMPFACDETALORDENCOMPR/ajaxupdate'), array(), array("style" => "display:none;"));  ?>
    <?php // echo CHtml::ajaxSubmitButton('Activate', array('TEMPFACDETALORDENCOMPR/ajaxupdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
    <?php // echo CHtml::ajaxSubmitButton('In Activate', array('TEMPFACDETALORDENCOMPR/ajaxupdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
    <?php // echo CHtml::ajaxSubmitButton('Delete', array('TEMPFACDETALORDENCOMPR/ajaxupdate', 'act' => 'doDelete'), array('success' => 'reloadGrid')); ?>
    <?php // echo CHtml::ajaxSubmitButton('Update sort order', array('TEMPFACDETALORDENCOMPR/ajaxupdate', 'act' => 'NRO_UNID'), array('success' => 'reloadGrid')); ?>
    <?php // $this->endWidget(); ?>
</div>