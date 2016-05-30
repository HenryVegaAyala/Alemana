<?php
/* @var $this TEMPFACDETALORDENCOMPRController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tempfacdetalordencomprs',
);

$this->menu=array(
	array('label'=>'Create TEMPFACDETALORDENCOMPR', 'url'=>array('create')),
	array('label'=>'Manage TEMPFACDETALORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>Tempfacdetalordencomprs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
