<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs = array(
    'O/C' => array('index'),
    'Nuevo',
);
?>

<h1>Nuevo Orden de Compra</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>