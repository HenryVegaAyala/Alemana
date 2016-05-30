<?php
/* @var $this TEMPFACDETALORDENCOMPRController */
/* @var $model TEMPFACDETALORDENCOMPR */

$this->breadcrumbs=array(
	'Tempfacdetalordencomprs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TEMPFACDETALORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Manage TEMPFACDETALORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>Create TEMPFACDETALORDENCOMPR</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>