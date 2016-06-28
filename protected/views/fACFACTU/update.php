<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */

$this->breadcrumbs=array(
	'Facfactus'=>array('index'),
	$model->COD_FACT=>array('view','id'=>$model->COD_FACT),
	'Update',
);

$this->menu=array(
	array('label'=>'List FACFACTU', 'url'=>array('index')),
	array('label'=>'Create FACFACTU', 'url'=>array('create')),
	array('label'=>'View FACFACTU', 'url'=>array('view', 'id'=>$model->COD_FACT)),
	array('label'=>'Manage FACFACTU', 'url'=>array('admin')),
);
?>

<h1>Update FACFACTU <?php echo $model->COD_FACT; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>