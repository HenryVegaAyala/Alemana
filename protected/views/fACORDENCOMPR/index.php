<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'post',
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
                        'header' => 'cODTIEN',
                        'header' => 'Tienda',
                        'value' => '$data->cODTIEN->DES_TIEN'
                    ),
                    array(
                        'name' => 'FEC_INGR',
                        'header' => 'Fecha de Ingreso',
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_INGR))'
                    ),
                    array(
                        'name' => 'FEC_ENVI',
                        'header' => 'Fecha de Envio',
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_ENVI))'
                    ),
                    'TOT_FACT',
                    array(
                        'name' => 'IND_ESTA',
                        'header' => 'Estado',
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
                        'htmlOptions' => array('style' => 'width: 130px; text-align: center;'),
                        'template' => '{view} / {update} / {delete} / {Guia} / {Reporte}',
                        'buttons' => array(
//                            'delete' => array(
//                                'icon' => 'user',
//                                'label' => 'Delete',
//                                'htmlOptions' => array('style' => 'width: 50px'),
////                                'visible' => 'array("$data->IND_ESTA") < 1',
//                                'url' => 'Yii::app()->controller->createUrl("/FACORDENCOMPR/delete", array("id"=>$data->COD_ORDE))',
//                            ),
                            'Guia' => array(
                                'icon' => 'book',
                                'label' => 'Generar Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
//                                'visible' => 'array("$data->IND_ESTA") < 1',
                                'url' => 'Yii::app()->controller->createUrl("/FACORDENCOMPR/Guia", array("id"=>$data->COD_ORDE))',
                            ),
                            'Reporte' => array(
                                'icon' => 'file',
                                'label' => 'Generar PDF',
                                'htmlOptions' => array('style' => 'width: 50px'),
//                                'url' => 'Yii::app()->controller->createUrl("/FACORDENCOMPR/Reporte", array("id"=>$data->COD_ORDE))',
                                'url' => 'CHtml::normalizeUrl(array("Reporte", "id"=>$data->COD_ORDE))',
                                'options' => array('class' => 'Reporte'),
                            ),
                        ),
                    ),
                ),
            ));
            ?>

            <div class="panel-footer " style="overflow:hidden;text-align:right;">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-success btn-md')); ?>
                        <?php echo CHtml::submitButton('Eliminar', array('class' => 'btn btn-default btn-md')); ?>
                        <?php echo CHtml::link('Delete', "#", array("submit" => array('/FACORDENCOMPR/delete', 'id' => $model->COD_ORDE), 'confirm' => 'Are you sure?')); ?>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>    <?php $this->endWidget(); ?>
