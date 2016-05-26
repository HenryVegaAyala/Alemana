<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs=array(
	'Facordencomprs'=>array('index'),
	$model->COD_ORDE,
);

$this->menu=array(
	array('label'=>'List FACORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create FACORDENCOMPR', 'url'=>array('create')),
	array('label'=>'Update FACORDENCOMPR', 'url'=>array('update', 'id'=>$model->COD_ORDE)),
	array('label'=>'Delete FACORDENCOMPR', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_ORDE),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FACORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>View FACORDENCOMPR #<?php echo $model->COD_ORDE; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_CLIE',
		'COD_TIEN',
		'COD_ORDE',
		'NUM_ORDE',
		'IND_TIPO',
		'TIP_MONE',
		'TOT_UNID_SOLI',
		'TOT_MONT_ORDE',
		'TOT_MONT_IGV',
		'TOT_FACT',
		'FEC_PAGO',
		'IND_ESTA',
		'FEC_INGR',
		'FEC_ENVI',
		'FEC_ANUL',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
	),
)); ?>
