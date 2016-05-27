<?php
/* @var $this FACDETALORDENCOMPRController */
/* @var $model FACDETALORDENCOMPR */

$this->breadcrumbs=array(
	'Facdetalordencomprs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FACDETALORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create FACDETALORDENCOMPR', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facdetalordencompr-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Facdetalordencomprs</h1>

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
	'id'=>'facdetalordencompr-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'COD_CLIE',
		'COD_TIEN',
		'COD_ORDE',
		'COD_PROD',
		'NRO_UNID',
		'VAL_PREC',
		/*
		'VAL_IGV',
		'VAL_MONT_UNID',
		'VAL_MONT_IGV',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
