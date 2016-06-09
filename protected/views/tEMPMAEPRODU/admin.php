<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */

$this->breadcrumbs=array(
	'Tempmaeprodus'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TEMPMAEPRODU', 'url'=>array('index')),
	array('label'=>'Create TEMPMAEPRODU', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tempmaeprodu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tempmaeprodus</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tempmaeprodu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'COD_PROD',
		'COD_LINE',
		'DES_LARG',
		'DES_CORT',
		'COD_ESTA',
		'COD_MEDI',
		/*
		'VAL_PESO',
		'VAL_PROD',
		'VAL_CONV',
		'VAL_PORC',
		'VAL_COST',
		'VAL_REPO',
		'COD_LOTE',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
		'NRO_UNID',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
