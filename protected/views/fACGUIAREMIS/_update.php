<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */
/* @var $form CActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV2.css">
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Modificar Guia</h3>
        </div>


        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'facguiaremis-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php // echo $form->errorSummary($model);  ?>

        <div class="fieldset">
            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_GUIA'); ?>
                    <?php echo $form->textField($model, 'COD_GUIA', array('class' => 'form-control', 'readonly' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_GUIA'); ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_ORDE'); ?>
                    <?php echo $form->textField($model, 'COD_ORDE', array('class' => 'form-control', 'readonly' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_ORDE'); ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
                    <?php echo $form->dropDownList($model, 'COD_TIEN',$model->ListaTiendaUpdate(), array('class' => 'form-control', 'disabled' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_TIEN'); ?>
                </div>
            </div>

            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                    <?php echo $form->dropDownList($model, 'COD_CLIE',$model->ListaClienteUpdate(), array('class' => 'form-control', 'disabled' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_CLIE'); ?>
                </div>

                            <div class="form-group ir ">
                <div class="col-sm-4 control-label">
                    <?php echo $form->label($model, 'FEC_EMIS'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'FEC_EMIS',
                        'value' => $model->FEC_EMIS,
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Fecha Ingreso'),
                        'options' => array(
                            'autoSize' => true,
                            'defaultDate' => $model->FEC_EMIS,
                            'dateFormat' => 'yy-mm-dd',
                            'buttonImageOnly' => true,
                            'buttonText' => 'FEC_EMIS',
                            'selectOtherMonths' => true,
                            'showAnim' => 'fadeIn', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            'showOtherMonths' => true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                            'maxDate' => "+20Y",
                        ),
                    ));
                    ?>
                </div>

            </div>
            
                    <div class="container-fluid">
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;Datos del Cliente</legend>
            <div class="form-group ir">
                <?php
                $clie = $model->COD_CLIE;
                $tienda = $model->COD_TIEN;

                $connection = Yii::app()->db;
                $sqlStatement = "Select MC.NRO_RUC,MC.DES_CLIE,MT.DIR_TIEN from MAE_CLIEN MC, MAE_TIEND MT where  MC.COD_CLIE = MT.COD_CLIE and MT.COD_ESTA = 1 and MC.COD_ESTA = 1 and MC.COD_CLIE = $clie and MT.COD_TIEN = $tienda;";
                $command = $connection->createCommand($sqlStatement);
                $reader = $command->query();

                foreach ($reader as $row)
                ?>
                
                <div class="col-sm-4 control-label">
                    <label >RUC:</label>
                    <input type="text" value="<?php echo $row['NRO_RUC']?>" id="txtruc" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>RAZÓN SOCIAL:</label>
                    <input type="text" value="<?php echo $row['DES_CLIE']?>" id="txtRaZo" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>LUGAR DE ENTREGA:</label>
                    <input type="text" value="<?php echo $row['DIR_TIEN']?>" id="txtDIRE" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>
            </div>
        </div>
        <br>
        <div class="panel-footer " style="overflow:hidden;text-align:right;">
        </div>

        </div>

        <div class="panel-footer container-fluid" style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class' => 'btn btn-success btn-md')); ?>
                    <?php
                    $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'default',
                        'label' => 'Regresar',
                        'size' => 'default',
                        'buttonType' => 'link',
                        'url' => array('Lista')
                    ));
                    ?>
                </div>
            </div>  
        </div>
        <?php $this->endWidget(); ?>

    </div><!-- form -->