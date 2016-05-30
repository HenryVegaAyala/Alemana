<?php
/* @var $this TEMPFACDETALORDENCOMPRController */
/* @var $model TEMPFACDETALORDENCOMPR */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COD_ORDE'); ?>
		<?php echo $form->textField($model,'COD_ORDE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_PROD'); ?>
		<?php echo $form->textField($model,'COD_PROD',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NRO_UNID'); ?>
		<?php echo $form->textField($model,'NRO_UNID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_PREC'); ?>
		<?php echo $form->textField($model,'VAL_PREC',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_MONT_UNID'); ?>
		<?php echo $form->textField($model,'VAL_MONT_UNID',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_MONT_IGV'); ?>
		<?php echo $form->textField($model,'VAL_MONT_IGV',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_TOTAL'); ?>
		<?php echo $form->textField($model,'VAL_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DES_PROD'); ?>
		<?php echo $form->textField($model,'DES_PROD',array('size'=>60,'maxlength'=>475)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->