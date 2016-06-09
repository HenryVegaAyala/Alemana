<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'COD_PROD'); ?>
        <?php echo $form->textField($model, 'COD_PROD', array('size' => 12, 'maxlength' => 12)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'DES_LARG'); ?>
        <?php echo $form->textField($model, 'DES_LARG', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->