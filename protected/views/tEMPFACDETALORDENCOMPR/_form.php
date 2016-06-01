<?php
/* @var $this TEMPFACDETALORDENCOMPRController */
/* @var $model TEMPFACDETALORDENCOMPR */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'tempfacdetalordencompr-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'COD_PROD'); ?>
        <?php echo $form->textField($model, 'COD_PROD', array('size' => 12, 'maxlength' => 12)); ?>
        <?php echo $form->error($model, 'COD_PROD'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'NRO_UNID'); ?>
        <?php echo $form->textField($model, 'NRO_UNID'); ?>
        <?php echo $form->error($model, 'NRO_UNID'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'VAL_PREC'); ?>
        <?php echo $form->textField($model, 'VAL_PREC', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'VAL_PREC'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'VAL_MONT_UNID'); ?>
        <?php echo $form->textField($model, 'VAL_MONT_UNID', array('size' => 12, 'maxlength' => 12)); ?>
        <?php echo $form->error($model, 'VAL_MONT_UNID'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'VAL_MONT_IGV'); ?>
        <?php echo $form->textField($model, 'VAL_MONT_IGV', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'VAL_MONT_IGV'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'VAL_TOTAL'); ?>
        <?php echo $form->textField($model, 'VAL_TOTAL', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'VAL_TOTAL'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'DES_PROD'); ?>
        <?php echo $form->textField($model, 'DES_PROD', array('size' => 60, 'maxlength' => 475)); ?>
        <?php echo $form->error($model, 'DES_PROD'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->