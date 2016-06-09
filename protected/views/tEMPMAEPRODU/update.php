<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */

$this->breadcrumbs=array(
	'Tempmaeprodus'=>array('index'),
	$model->COD_PROD=>array('view','id'=>$model->COD_PROD),
	'Update',
);

$this->menu=array(
	array('label'=>'List TEMPMAEPRODU', 'url'=>array('index')),
	array('label'=>'Create TEMPMAEPRODU', 'url'=>array('create')),
	array('label'=>'View TEMPMAEPRODU', 'url'=>array('view', 'id'=>$model->COD_PROD)),
	array('label'=>'Manage TEMPMAEPRODU', 'url'=>array('admin')),
);
?>

<h1>Update TEMPMAEPRODU <?php echo $model->COD_PROD; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>