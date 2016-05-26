<?php
/* @var $this FACORDENCOMPRController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Facordencomprs',
);

$this->menu=array(
	array('label'=>'Create FACORDENCOMPR', 'url'=>array('create')),
	array('label'=>'Manage FACORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>Facordencomprs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
