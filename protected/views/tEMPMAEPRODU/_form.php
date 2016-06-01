<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */
/* @var $form CActiveForm */
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV2.css">


<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registrar Nuevo O/C</h3>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'tempmaeprodu-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <div class="fieldset">

            <div class="form-group ir">
                <div class="col-xs-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_PROD'); ?>
                    <?php echo $form->textField($model, 'COD_PROD', array('class' => 'form-control', 'readonly' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_PROD'); ?>
                </div>

                <div class="col-xs-4 control-label">
                    <?php echo $form->labelEx($model, 'DES_LARG'); ?>
                    <?php echo $form->textField($model, 'DES_LARG', array('class' => 'form-control', 'readonly' => 'true')); ?>
                    <?php echo $form->error($model, 'DES_LARG'); ?>
                </div>

                <div class="col-xs-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_MEDI'); ?>
                    <?php echo $form->dropDownList($model, 'COD_MEDI',$model->getLinea(), array('class' => 'form-control','disabled'=>'disabled')); ?>
                    <?php echo $form->error($model, 'COD_MEDI'); ?>
                </div>
            </div>

            <div class="form-group ir">
                <div class="col-xs-4 control-label">
                    <?php echo $form->labelEx($model, 'NRO_UNID'); ?>
                    <?php echo $form->textField($model, 'NRO_UNID', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'NRO_UNID'); ?>
                </div>

                <div class="col-xs-4 control-label">
                    <?php echo $form->labelEx($model, 'VAL_PROD'); ?>
                    <?php echo $form->textField($model, 'VAL_PROD', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'VAL_PROD'); ?>
                </div>

                <div class="col-xs-4 control-label">
                    <?php // echo $form->labelEx($model, 'VAL_TOTAL'); ?>
                    <?php echo $form->textField($model, 'VAL_TOTAL', array('class' => 'form-control', 'readonly' => 'true', 'style' => 'visibility: hidden')); ?>
                    <?php // echo $form->error($model, 'VAL_TOTAL'); ?>
                </div>

            </div>
        </div>
        <br>
        <br><br><br><br><br><br><br>
        <div class="panel-footer " style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class' => 'btn btn-success btn-md')); ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div><!-- form -->