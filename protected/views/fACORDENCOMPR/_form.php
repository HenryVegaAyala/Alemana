<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */
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
            'id' => 'facordencompr-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <br>
        <div class="container-fluid">
            <p class="note">Los aspectos con <span class="required letra"> (*) </span> son requeridos.</p>
        </div>

        <?php
        echo $form->errorSummary($model);
        ?>

        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'midialogo',
            // Opciones adicionales javascript
            'options' => array(
                'title' => 'Porfavor Ingresar los aspectos requeridos. ',
                'autoOpen' => false,
                'resizable' => false,
                'modal' => true,
                'width' => 'auto',
                'height' => 'auto',
                'closeOnEscape' => true,
            ),
        ));

        $this->endWidget('zii.widgets.jui.CJuiDialog');

        // Link que abre la ventana de diálogo
//        echo CHtml::link('Abrir ventana', '#', array(
//            'onclick' => '$("#midialogo").dialog("open"); return false;',
//        ));
        ?>

        <div class="fieldset">

            <div class="form-group ir">
                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'NUM_ORDE'); ?>
                    <?php echo $form->textField($model, 'NUM_ORDE', array('maxlength' => 6, 'class' => 'form-control', 'placeholder' => 'N° de Orden')); ?>
                    <?php // echo $form->error($model, 'NUM_ORDE'); ?>
                </div>

                <div class="col-sm-3 control-label">

                    <?php
                    $htmlOptions = array(
                        "ajax" => array(
                            "url" => $this->createUrl("ClienteByTienda"),
                            "type" => "POST",
//                            "data" => array('COD_CLIE' => 'js:this.value'),
                            "update" => "#FACORDENCOMPR_COD_TIEN"
                        ),
                        'class' => 'form-control',
                        'empty' => 'Seleccionar Cliente',
                    );
                    ?>
                    <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                    <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaCliente(), $htmlOptions); ?>

                </div>

                <div class="col-sm-3 control-label">
                    <?php
                    $htmlOption = array(
                        "ajax" => array(
                            "url" => $this->createUrl("ValorTienda"),
                            "type" => "POST",
//                            "update" => "#txtruc, txtRaZo,txtDIRE",
                            // "data" => array('COD_TIEN' => 'js:this.value'),
                            "success" => "function(data){   
                                
                            cadena = data.split('/');    

                           var ruc=document.getElementById('txtruc');
                           ruc.value= cadena[0];

                           var razo=document.getElementById('txtRaZo');
                           razo.value= cadena[1];
                           
                            var dire=document.getElementById('txtDIRE');
                           dire.value= cadena[2];     

                           }
                            "
                        ),
                        'class' => 'form-control',
                        'empty' => 'Seleccionar Tienda'
                    );
                    ?>
                    <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
                    <?php echo $form->dropDownList($model, 'COD_TIEN', $model->ListaTienda(), $htmlOption); ?>
                    <?php // echo $form->error($model, 'COD_TIEN'); ?>

                </div>                

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'TIP_MONE'); ?>
                    <?php echo $form->dropDownList($model, 'TIP_MONE', $model->Moneda(), array('class' => 'form-control')); ?>
                    <?php // echo $form->error($model, 'TIP_MONE'); ?>
                </div>               
            </div>

            <div class="form-group ir">
                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'FEC_INGR'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'FEC_INGR',
                        'value' => $model->FEC_INGR,
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Ingrese la Fecha Ingreso'),
                        'options' => array(
                            'autoSize' => true,
                            'defaultDate' => $model->FEC_INGR,
                            'dateFormat' => 'yy/mm/dd',
                            'buttonImage' => Yii::app()->baseUrl . '/images/calendario.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'FEC_INGR',
                            'selectOtherMonths' => true,
                            'showAnim' => 'fadeIn', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            'showOtherMonths' => true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                            'minDate' => 'date("Y-MM-DD")',
                            'maxDate' => "+20Y",
                        ),
                    ));
                    ?>
                    <?php // echo $form->error($model, 'FEC_INGR'); ?>
                </div>

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'FEC_ENVI'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'FEC_ENVI',
                        'value' => $model->FEC_ENVI,
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Ingrese la Fecha Envio'),
                        'options' => array(
                            'autoSize' => true,
                            'defaultDate' => $model->FEC_ENVI,
                            'dateFormat' => 'yy/mm/dd',
                            'buttonImageOnly' => true,
                            'buttonText' => 'FEC_ENVI',
                            'selectOtherMonths' => true,
                            'showAnim' => 'slide',
                            'showOtherMonths' => true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                            'minDate' => 'date("Y-MM-DD")',
                            'maxDate' => "+20Y",
                        ),
                    ));
                    ?>
                    <?php // echo $form->error($model, 'FEC_ENVI'); ?>
                </div>

                <div class="col-sm-3 control-label">
                    <?php // echo $form->labelEx($model, 'COD_ORDE');  ?>
                    <?php echo $form->textField($model, 'COD_ORDE', array('value' => $model->au(), 'size' => 6, 'maxlength' => 6, 'style' => 'visibility: hidden')); ?>
                    <?php // echo $form->error($model, 'COD_ORDE'); ?>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;Datos del Cliente</legend>
            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <label >RUC:</label>
                    <input type="text" id="txtruc" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>RAZÓN SOCIAL:</label>
                    <input type="text" id="txtRaZo" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>LUGAR DE ENTREGA:</label>
                    <input type="text" id="txtDIRE" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>
            </div>
        </div>
        <br>
        <div class="panel-footer " style="overflow:hidden;text-align:right;">
        </div>

        <?php
        $url = Yii::app()->request->baseUrl;
        echo CHtml::button('Agregar Nuevo Producto', array(
            'name' => 'Agregar Nuevo Producto',
            'class' => 'btn btn-link btn-md',
            'onclick' => "window.open ('?r=TEMPMAEPRODU/index', 'nom_interne_de_la_fenetre', config='height=420, width=750, toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, directories=no, status=no')"
        ));
        ?>

        <script type="text/javascript">
            function refreshList()
            {
                $.fn.yiiGridView.update("tempfacdetalordencompr-grid");
            }
            var interval = setInterval("refreshList()", 6000);
        </script>

        <?php
        $this->renderPartial('/TEMPFACDETALORDENCOMPR/admin', array(
            'model' => $modelOC
        ));
        ?>

        <div class="container-fluid">
            <table align="right">
                <tbody>
                    <tr>
                        <td class="col-sm-4">
                            <?php echo $form->labelEx($model, 'TOT_MONT_ORDE'); ?>
                        </td>
                        <td>         
                            <?php
                            echo $form->textField($model, 'TOT_MONT_ORDE', array(
                                'value' => $model->SubTotal(),
                                'size' => 6,
                                'maxlength' => 6,
                                'class' => 'form-control',
                                'style' => 'background-color: transparent;',
                                'disabled' => 'true'
                            ));
                            ?>
                            <?php echo $form->error($model, 'TOT_MONT_ORDE'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-sm-4">
                            <?php echo $form->labelEx($model, 'TOT_MONT_IGV'); ?>
                        </td>
                        <td>
                            <?php
                            echo $form->textField($model, 'TOT_MONT_IGV', array(
                                'value' => $model->au(),
                                'size' => 6, 
                                'maxlength' => 6,
                                'class' => 'form-control',
                                'style' => 'background-color: transparent;',
                                'disabled' => 'true'
                            ));
                            ?>
                            <?php echo $form->error($model, 'TOT_MONT_IGV'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-sm-4">
                            <?php echo $form->labelEx($model, 'TOT_FACT'); ?>
                        </td>
                        <td>                
                            <?php
                            echo $form->textField($model, 'TOT_FACT', array(
                                'value' => $model->au(),
                                'size' => 6,
                                'maxlength' => 6,
                                'class' => 'form-control',
                                'style' => 'background-color: transparent;',
                                'disabled' => 'true'
                            ))
                            ?>
                            <?php echo $form->error($model, 'TOT_FACT'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="clear"> </div>

        <div class="panel-footer " style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class' => 'btn btn-success btn-md')); ?>
                    <input type="reset" src="create.php" class="btn btn-default btn-md" value="Cancelar">
                </div>
            </div>  
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
