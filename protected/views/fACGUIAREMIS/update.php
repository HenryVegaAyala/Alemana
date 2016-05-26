<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */

$this->breadcrumbs=array(
	'Facguiaremises'=>array('index'),
	$model->COD_GUIA=>array('view','id'=>$model->COD_GUIA),
	'Update',
);

$this->menu=array(
	array('label'=>'List FACGUIAREMIS', 'url'=>array('index')),
	array('label'=>'Create FACGUIAREMIS', 'url'=>array('create')),
	array('label'=>'View FACGUIAREMIS', 'url'=>array('view', 'id'=>$model->COD_GUIA)),
	array('label'=>'Manage FACGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>Update FACGUIAREMIS <?php echo $model->COD_GUIA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>