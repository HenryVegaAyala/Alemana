<?php
/* @var $this TEMPMAEPRODUController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tempmaeprodus',
);

$this->menu=array(
	array('label'=>'Create TEMPMAEPRODU', 'url'=>array('create')),
	array('label'=>'Manage TEMPMAEPRODU', 'url'=>array('admin')),
);
?>

<h1>Tempmaeprodus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
