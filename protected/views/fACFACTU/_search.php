<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COD_FACT'); ?>
		<?php echo $form->textField($model,'COD_FACT',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_CLIE'); ?>
		<?php echo $form->textField($model,'COD_CLIE',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_GUIA'); ?>
		<?php echo $form->textField($model,'COD_GUIA',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_FACT'); ?>
		<?php echo $form->textField($model,'FEC_FACT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_PAGO'); ?>
		<?php echo $form->textField($model,'FEC_PAGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IND_ESTA'); ?>
		<?php echo $form->textField($model,'IND_ESTA',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_IGV'); ?>
		<?php echo $form->textField($model,'VAL_IGV',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_UNID_FACT'); ?>
		<?php echo $form->textField($model,'TOT_UNID_FACT',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_FACT_SIN_IGV'); ?>
		<?php echo $form->textField($model,'TOT_FACT_SIN_IGV',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_IGV'); ?>
		<?php echo $form->textField($model,'TOT_IGV',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_FACT'); ?>
		<?php echo $form->textField($model,'TOT_FACT',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USU_DIGI'); ?>
		<?php echo $form->textField($model,'USU_DIGI',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_DIGI'); ?>
		<?php echo $form->textField($model,'FEC_DIGI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USU_MODI'); ?>
		<?php echo $form->textField($model,'USU_MODI',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_MODI'); ?>
		<?php echo $form->textField($model,'FEC_MODI'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->