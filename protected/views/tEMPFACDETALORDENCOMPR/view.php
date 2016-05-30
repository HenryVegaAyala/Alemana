<?php
/* @var $this TEMPFACDETALORDENCOMPRController */
/* @var $model TEMPFACDETALORDENCOMPR */

$this->breadcrumbs=array(
	'Tempfacdetalordencomprs'=>array('index'),
	$model->COD_ORDE,
);

$this->menu=array(
	array('label'=>'List TEMPFACDETALORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create TEMPFACDETALORDENCOMPR', 'url'=>array('create')),
	array('label'=>'Update TEMPFACDETALORDENCOMPR', 'url'=>array('update', 'id'=>$model->COD_ORDE)),
	array('label'=>'Delete TEMPFACDETALORDENCOMPR', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_ORDE),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TEMPFACDETALORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>View TEMPFACDETALORDENCOMPR #<?php echo $model->COD_ORDE; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_ORDE',
		'COD_PROD',
		'NRO_UNID',
		'VAL_PREC',
		'VAL_MONT_UNID',
		'VAL_MONT_IGV',
		'VAL_TOTAL',
		'DES_PROD',
	),
)); ?>
