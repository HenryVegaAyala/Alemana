<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */

$this->breadcrumbs = array(
    'Factura' => array('index'),
    'Buscar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facfactu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'facfactu-grid',
    'type' => 'bordered condensed striped',
    'dataProvider' => $model->search(),
    'columns' => array(
//        'COD_FACT',
        'COD_GUIA',
        'COD_CLIE',
        'FEC_FACT',
        'FEC_PAGO',
        'IND_ESTA',
        'TOT_FACT',
        array(
            'header' => 'Opciones',
            'class' => 'ext.bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 130px; text-align: center;'),
        ),
    ),
));
?>
