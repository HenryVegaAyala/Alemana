<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COD_CLIE'); ?>
		<?php echo $form->textField($model,'COD_CLIE',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_TIEN'); ?>
		<?php echo $form->textField($model,'COD_TIEN',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_ORDE'); ?>
		<?php echo $form->textField($model,'COD_ORDE',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NUM_ORDE'); ?>
		<?php echo $form->textField($model,'NUM_ORDE',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IND_TIPO'); ?>
		<?php echo $form->textField($model,'IND_TIPO',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TIP_MONE'); ?>
		<?php echo $form->textField($model,'TIP_MONE',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_UNID_SOLI'); ?>
		<?php echo $form->textField($model,'TOT_UNID_SOLI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_MONT_ORDE'); ?>
		<?php echo $form->textField($model,'TOT_MONT_ORDE',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_MONT_IGV'); ?>
		<?php echo $form->textField($model,'TOT_MONT_IGV',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOT_FACT'); ?>
		<?php echo $form->textField($model,'TOT_FACT',array('size'=>10,'maxlength'=>10)); ?>
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
		<?php echo $form->label($model,'FEC_INGR'); ?>
		<?php echo $form->textField($model,'FEC_INGR'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_ENVI'); ?>
		<?php echo $form->textField($model,'FEC_ENVI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_ANUL'); ?>
		<?php echo $form->textField($model,'FEC_ANUL'); ?>
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