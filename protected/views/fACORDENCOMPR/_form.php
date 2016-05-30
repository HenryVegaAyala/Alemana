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

        <?php echo $form->errorSummary($model); ?>

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
                            "update" => "#FACORDENCOMPR_COD_TIEN"
                        ),
                        'class' => 'form-control',
                        'empty' => 'Seleccionar Cliente',
                    );
                    ?>
                    <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                    <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaCliente(), $htmlOptions); ?>
                    <?php // echo $form->error($model, 'COD_CLIE'); ?>
                </div>

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
                    <?php echo $form->dropDownList($model, 'COD_TIEN', $model->ListaTienda(), array('class' => 'form-control', 'empty' => 'Seleccionar Tienda')); ?>
                    <?php // echo $form->error($model, 'COD_TIEN'); ?>
                </div>                

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'TIP_MONE'); ?>
                    <?php echo $form->dropDownList($model, 'TIP_MONE', $model->Moneda(), array('class' => 'form-control', 'empty' => 'Seleccionar Moneda')); ?>
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
                    <?php // echo $form->labelEx($model, 'COD_ORDE'); ?>
                    <?php echo $form->textField($model, 'COD_ORDE', array('value' => $model->au(), 'size' => 6, 'maxlength' => 6, 'style' => 'visibility: hidden')); ?>
                    <?php // echo $form->error($model, 'COD_ORDE'); ?>
                </div>
            </div>

        </div>

        <br><br><br><br><br><br><br><br>    

        <?php
//        $connection = Yii::app()->db;
//        $sqlStatement = "Select * from MAE_CLIEN WHERE COD_CLIE = 1";
//        $command = $connection->createCommand($sqlStatement);
//        $reader = $command->query();
//
//        foreach ($reader as $row)
//            echo $row['NRO_RUC'];
        ?>

        <fieldset>
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;Datos del Cliente</legend>
            <div class="form-group">
                <div class="col-sm-4 control-label">
                    <label>RUC:</label>
                </div>

                <div class="col-sm-4 control-label">
                    <label>RAZÓN SOCIAL:</label>
                </div>

                <div class="col-sm-4 control-label">
                    <label>LUGAR DE ENTREGA:</label>
                </div>
            </div>
        </fieldset>

        <div class="panel-footer " style="overflow:hidden;text-align:right;">
        </div>

        <?php
        $url = Yii::app()->request->baseUrl;
        echo CHtml::button('Agregar Nuevo Producto', array(
            'name' => 'Agregar Nuevo Producto',
            'onclick' => "window.open ('?r=mAEPRODU/index', 'nom_interne_de_la_fenetre', config='height=400, width=750, toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, directories=no, status=no')"
        ));
        ?>

        <script type="text/javascript">
            function refreshList()
            {
                $.fn.yiiGridView.update("facdetalordencompr-grid");
            }
            var interval = setInterval("refreshList()", 6000);
        </script>

        <p class="note">Porfavor espere los productos estan cargando...</p>
        <?php
        $this->renderPartial('/fACDETALORDENCOMPR/admin', array(
            'model' => $modelOC
        ));
        ?>

        <div class="panel-footer " style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class' => 'btn btn-success btn-md')); ?>
                    <input type="reset" src="create" class="btn btn-default btn-md" onclick="abrir()" value="Cancelar">
                </div>
            </div>  
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
