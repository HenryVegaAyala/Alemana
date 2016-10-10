<?php
/* @var $this OCController */
/* @var $model OC */

$this->breadcrumbs = array(
    'O.C.' => array('index'),
    'Nuevo',
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>