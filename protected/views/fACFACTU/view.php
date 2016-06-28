<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */

$this->breadcrumbs=array(
	'Facfactus'=>array('index'),
	$model->COD_FACT,
);

$this->menu=array(
	array('label'=>'List FACFACTU', 'url'=>array('index')),
	array('label'=>'Create FACFACTU', 'url'=>array('create')),
	array('label'=>'Update FACFACTU', 'url'=>array('update', 'id'=>$model->COD_FACT)),
	array('label'=>'Delete FACFACTU', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_FACT),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FACFACTU', 'url'=>array('admin')),
);
?>

<h1>View FACFACTU #<?php echo $model->COD_FACT; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_FACT',
		'COD_CLIE',
		'COD_GUIA',
		'FEC_FACT',
		'FEC_PAGO',
		'IND_ESTA',
		'VAL_IGV',
		'TOT_UNID_FACT',
		'TOT_FACT_SIN_IGV',
		'TOT_IGV',
		'TOT_FACT',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
	),
)); ?>
