<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="fieldset">
        <div class="container-fluid">
        <div class="form-group ir">
            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'COD_TIEN'); ?>
                <?php echo $form->textField($model, 'COD_TIEN', array('class' => 'form-control')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'COD_ORDE'); ?>
                <?php echo $form->textField($model, 'COD_ORDE', array('class' => 'form-control')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'IND_ESTA'); ?>
                <?php echo $form->textField($model, 'IND_ESTA', array('class' => 'form-control')); ?>
            </div>
 </div>
        
        <div class="form-group ir">
            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'FEC_INGR'); ?>
                               <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'FEC_INGR',
                    'value' => $model->FEC_INGR,
                    'language' => 'es',
                    'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Ingrese la Fecha Inicio'),
                    'options' => array(
                        'autoSize' => true,
                        'defaultDate' => $model->FEC_INGR,
                        'dateFormat' => 'dd-MM-yy',
                        'buttonImage' => Yii::app()->baseUrl . '/images/calendario.gif',
                        'buttonImageOnly' => true,
                        'buttonText' => 'FEC_INGR',
                        'selectOtherMonths' => true,
                        'showAnim' => 'slide',
                        'showOtherMonths' => true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'maxDate' => "+20Y",
                    ),
                ));
                ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'FEC_ENVI'); ?>
                                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'FEC_ENVI',
                    'value' => $model->FEC_ENVI,
                    'language' => 'es',
                    'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Ingrese la Fecha Inicio'),
                    'options' => array(
                        'autoSize' => true,
                        'defaultDate' => $model->FEC_ENVI,
                        'dateFormat' => 'dd-MM-yy',
                        'buttonImage' => Yii::app()->baseUrl . '/images/calendario.gif',
                        'buttonImageOnly' => true,
                        'buttonText' => 'FEC_ENVI',
                        'selectOtherMonths' => true,
                        'showAnim' => 'slide',
                        'showOtherMonths' => true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'maxDate' => "+20Y",
                    ),
                ));
                ?>
            </div>
            
                            <div class="col-sm-3 control-label">
                    <?php echo $form->textField($model, 'COD_ORDE', array('value' => $model->au(), 'size' => 6, 'maxlength' => 6, 'style' => 'visibility: hidden')); ?>
                </div>
            
</div>
        

        <div class="panel-footer " style="overflow:hidden;text-align:right;">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-success btn-md')); ?>
                        <input type="reset" src="create" class="btn btn-default btn-md" value="Cancelar">
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- search-form -->