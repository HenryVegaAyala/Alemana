<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */

$this->breadcrumbs=array(
	'Tempmaeprodus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TEMPMAEPRODU', 'url'=>array('index')),
	array('label'=>'Manage TEMPMAEPRODU', 'url'=>array('admin')),
);
?>

<h1>Create TEMPMAEPRODU</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>