<?php
/* @var $this TEMPFACDETALORDENCOMPRController */
/* @var $model TEMPFACDETALORDENCOMPR */

$this->breadcrumbs=array(
	'Tempfacdetalordencomprs'=>array('index'),
	$model->COD_ORDE=>array('view','id'=>$model->COD_ORDE),
	'Update',
);

$this->menu=array(
	array('label'=>'List TEMPFACDETALORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create TEMPFACDETALORDENCOMPR', 'url'=>array('create')),
	array('label'=>'View TEMPFACDETALORDENCOMPR', 'url'=>array('view', 'id'=>$model->COD_ORDE)),
	array('label'=>'Manage TEMPFACDETALORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>Update TEMPFACDETALORDENCOMPR <?php echo $model->COD_ORDE; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>