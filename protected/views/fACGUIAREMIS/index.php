<?php
/* @var $this FACGUIAREMISController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Facguiaremises',
);

$this->menu=array(
	array('label'=>'Create FACGUIAREMIS', 'url'=>array('create')),
	array('label'=>'Manage FACGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>Facguiaremises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
