<?php
$this->breadcrumbs = array(
    'Lista de Presupuestos',
);
?>

<div class="container-fluid">
    <center>
        <img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/logo.jpg' ?>">
        <img align="center" 		   src="<?php echo Yii:: app()->baseUrl . '/images/datos.jpg' ?>" >
    </center>
</div>

<?php echo $this->renderPartial('migrar', array('model' => $model)); ?>