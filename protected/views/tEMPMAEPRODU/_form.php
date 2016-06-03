<?php
/* @var $this TEMPMAEPRODUController */
/* @var $model TEMPMAEPRODU */
/* @var $form CActiveForm */
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV2.css">


<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registrar Productos del O/C</h3>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'tempmaeprodu-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <div class="container-fluid">
            <div class="fieldset">

                <div class="form-group ir">
                    <div class="col-xs-4 control-label">
                        <?php
                        $htmlOption1 = array(
                            "ajax" => array(
                                "url" => $this->createUrl("Arreglo"),
                                "type" => "POST",
                                "success" => "function(data){   
                                
                           var valor1=document.getElementById('txtvalor');
                           valor1.value= data;  

                           }
                            "
                            ),
                            'class' => 'form-control',
                            'readonly' => true,
                        );
                        ?>
                        <?php echo $form->labelEx($model, 'COD_PROD'); ?>
                        <?php echo $form->textField($model, 'COD_PROD', $htmlOption1); ?>
                        <?php echo $form->error($model, 'COD_PROD'); ?>
                    </div>

                    <div class="col-xs-4 control-label">
                        <?php
                        $htmlOption2 = array(
                            "ajax" => array(
                                "url" => $this->createUrl("Arreglo"),
                                "type" => "POST",
                                "success" => "function(data){   
                                
                           var valor1=document.getElementById('txtvalor');
                           valor1.value= data;  

                           }
                            "
                            ),
                            'class' => 'form-control',
                            'readonly' => true,
                        );
                        ?>
                        <?php echo $form->labelEx($model, 'DES_LARG'); ?>
                        <?php echo $form->textField($model, 'DES_LARG', $htmlOption2); ?>
                        <?php echo $form->error($model, 'DES_LARG'); ?>
                    </div>

                    <div class="col-xs-4 control-label">
                        <?php
                        $htmlOption3 = array(
                            "ajax" => array(
                                "url" => $this->createUrl("Arreglo"),
                                "type" => "POST",
                                "success" => "function(data){   
                                
                           var valor1=document.getElementById('txtvalor');
                           valor1.value= data;  

                           }
                            "
                            ),
                            'class' => 'form-control',
//                            'disabled' => 'disabled',
                        );
                        ?>
                        <?php echo $form->labelEx($model, 'COD_MEDI'); ?>
                        <?php echo $form->dropDownList($model, 'COD_MEDI', $model->getLinea(), $htmlOption3); ?>
                        <?php echo $form->error($model, 'COD_MEDI'); ?>
                    </div>
                </div>

                <div class="form-group container-fluid">
                    <div class="col-xs-4 control-label">
                        <?php
                        $htmlOption4 = array(
                            "ajax" => array(
                                "url" => $this->createUrl("Arreglo"),
                                "type" => "POST",
                                "success" => "function(data){   
                                
                           var valor1=document.getElementById('txtvalor');
                           valor1.value= data;  

                           }
                            "
                            ),
                            'class' => 'form-control',
                        );
                        ?>
                        <?php echo $form->labelEx($model, 'NRO_UNID'); ?>
                        <?php echo $form->textField($model, 'NRO_UNID', $htmlOption4); ?>
                        <?php echo $form->error($model, 'NRO_UNID'); ?>
                    </div>

                    <div class="col-xs-4 control-label">
                        <?php
                        $htmlOption5 = array(
                            "ajax" => array(
                                "url" => $this->createUrl("Arreglo"),
                                "type" => "POST",
                                "success" => "function(data){   
                                
                           var valor1=document.getElementById('txtvalor');
                           valor1.value= data;  

                           }
                            "
                            ),
                            'class' => 'form-control',
                        );
                        ?>
                        <?php echo $form->labelEx($model, 'VAL_PROD'); ?>
                        <?php echo $form->textField($model, 'VAL_PROD', $htmlOption5); ?>
                        <?php echo $form->error($model, 'VAL_PROD'); ?>
                    </div>
                    
                    <div class="col-xs-4 control-label">
                                                <?php
                        $htmlOption6 = array(
                            "ajax" => array(
                                "url" => $this->createUrl("Arreglo"),
                                "type" => "POST",
                                "success" => "function(data){   
                                
                           var valor1=document.getElementById('txtvalor');
                           valor1.value= data;  

                           }
                            "
                            ),
                            'class' => 'form-control',
                            'value'=>$model->au(),
                            'style' => 'visibility: hidden'
                        );
                        ?>
                        <?php echo $form->textField($model, 'N_ORDEN',$htmlOption6); ?>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="panel-footer " style="overflow:hidden;text-align:right;">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class' => 'btn btn-success btn-md')); ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
        <?php $this->endWidget(); ?>

    </div><!-- form -->