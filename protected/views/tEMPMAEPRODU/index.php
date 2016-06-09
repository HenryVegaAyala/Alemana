<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

");
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" >
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
