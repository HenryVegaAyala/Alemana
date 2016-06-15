<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs = array(
    'Lista de O/C',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facordencompr-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda O/C</h3>
        </div>

        <div class="mar">
            <?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
        </div>
        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div><!-- search-form -->

        <div class="table-responsive">
            <?php
            $this->widget('ext.bootstrap.widgets.TbGridView', array(
                'id' => 'facordencompr-grid',
                'type' => 'bordered condensed striped',
                'dataProvider' => $model->search(),
                'columns' => array(
                    array(
                        'id' => 'COD_ORDE',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    'NUM_ORDE',
                    array(
                        'header' => 'Tienda',
                        'value' => '$data->cODTIEN->DES_TIEN'
                    ),
                    'FEC_INGR',
                    'FEC_ENVI',
                    'TOT_FACT',
                    array(
                        'name' => 'Estado',
                        'value' => function($data) {

                            $variable = $data->__GET('IND_ESTA');
                            switch ($variable) {
                                case 1:
                                    echo 'En Proceso';
                                    break;
                                case 2:
                                    echo 'Despacho/Atendido';
                                    break;
                                case 9:
                                    echo 'Anulado';
                                    break;
                                case 0:
                                    echo 'Creado';
                                    break;
                            }
                        },
                    ),
                    array(
                        'header' => 'Opciones',
                        'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                        'htmlOptions' => array('style' => 'width: 77px; text-align: center;'),
                        'template' => '{view}{update}{delete}',
                    ),
                ),
            ));
            ?>
<!--            <script>
                function reloadGrid(data) {
                    $.fn.yiiGridView.update('facordencompr-grid');
                }
                var interval = setInterval("reloadGrid()", 6000);
            </script>-->
            <script>
                function reloadGrid(data) {
                    $.fn.yiiGridView.update('facordencompr-grid');
                }
            </script>

            <div class="panel-footer " style="overflow:hidden;text-align:right;">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-success btn-md')); ?>
                        <?php echo CHtml::ajaxSubmitButton('Generar Guias', array('class' => 'btn btn-success btn-md'), array('menu/ajaxupdate', 'act' => 'doDelete'), array('success' => 'reloadGrid')); ?>
                        
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>    <?php $this->endWidget(); ?>
