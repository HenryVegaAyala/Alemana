<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs=array(
	'Facordencomprs'=>array('index'),
	$model->COD_ORDE=>array('view','id'=>$model->COD_ORDE),
	'Update',
);

$this->menu=array(
	array('label'=>'List FACORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create FACORDENCOMPR', 'url'=>array('create')),
	array('label'=>'View FACORDENCOMPR', 'url'=>array('view', 'id'=>$model->COD_ORDE)),
	array('label'=>'Manage FACORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>Update FACORDENCOMPR <?php echo $model->COD_ORDE; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>