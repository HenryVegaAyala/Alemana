<?php

/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */

$this->breadcrumbs = array(
    'Productos' => array('index'),
    'Agregar Cantidad',
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>