<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */

$this->breadcrumbs=array(
	'Facguiaremises'=>array('index'),
	$model->COD_GUIA,
);

$this->menu=array(
	array('label'=>'List FACGUIAREMIS', 'url'=>array('index')),
	array('label'=>'Create FACGUIAREMIS', 'url'=>array('create')),
	array('label'=>'Update FACGUIAREMIS', 'url'=>array('update', 'id'=>$model->COD_GUIA)),
	array('label'=>'Delete FACGUIAREMIS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_GUIA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FACGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>View FACGUIAREMIS #<?php echo $model->COD_GUIA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_GUIA',
		'COD_ORDE',
		'COD_TIEN',
		'COD_CLIE',
		'FEC_EMIS',
		'DIR_PART',
		'FEC_TRAS',
		'COS_FLET',
		'COD_EMPR_TRAN',
		'COD_UNID_TRAN',
		'COD_MOTI_TRAS',
		'IND_ESTA',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
	),
)); ?>
