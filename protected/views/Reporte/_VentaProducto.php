
<div class="form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Reporte de Venta</h3>
        </div>

        <?php
        $url = Yii::app()->request->baseUrl;
        echo CHtml::beginForm('' . $url . '/Reporte/ReporteVentaProducto', 'POST', array('id' => 'Reporte', 'name' => 'Reporte', 'target' => '_blank'));
        ?>

        <div class="container-fluid">

            <div class="form-group">
                <div class="col-sm-3 ">
                    <h4><label>Fecha de Inicio:</label></h4>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'id' => 'Fecha_Ini',
                        'name' => 'Fecha_Ini',
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Fecha Inicio'),
                        'options' => array(
                            'autoSize' => true,
                            'dateFormat' => 'dd/mm/yy',
                            'buttonImageOnly' => true,
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

                <div class="col-sm-3">
                    <h4><label>Fecha Fin:</label></h4>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'id' => 'Fecha_Fin',
                        'name' => 'Fecha_Fin',
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Fecha Final'),
                        'options' => array(
                            'autoSize' => true,
                            'dateFormat' => 'dd/mm/yy',
                            'buttonImageOnly' => true,
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

                <div class="col-sm-3">
                    <h4><label>Cliente:</label></h4>
                    <?php
                    echo CHtml::dropDownList('Cod_Clie', 'DES_CLIE', CHtml::listData(MAECLIEN::model()->fin, 'COD_CLIE', 'DES_CLIE'), array('class' => 'form-control', 'empty' => 'Seleccionar Cliente',));
                    ?>
                </div>       

                <div class="col-sm-3">
                    <h4><label>Tienda:</label></h4>
                    <?php
                    echo CHtml::dropDownList('Cod_Tiend', 'DES_TIEND', CHtml::listData(MAETIEND::model()->findAll(), 'COD_TIEN', 'DES_TIEN'), array('class' => 'form-control', 'empty' => 'Seleccionar Tienda',));
                    ?>
                </div>          
            </div>

        </div>

        <div class="container-fluid">

            <div class="form-group">
                <div class="col-sm-3 ">
                    <h4><label>Estado:</label></h4>
                    <?php
                    echo CHtml::dropDownList('Estado', 'DES_ESTA', 
                            array(
                                '1'=>'En Proceso', 
                                '2'=>'Despachadado/Atendido', 
                                '9'=>'Anulado',
                                '0'=>'Creado'), 
                            array(
                                'class' => 'form-control', 
                                'empty' => 'Seleccionar Cliente',)
                            );
                    ?>
                </div>

                <div class="col-sm-3">
                </div>

                <div class="col-sm-3">
                </div>       

                <div class="col-sm-3">
                </div>          
            </div>

        </div>

        <br>

        <div class="panel-footer container-fluid" style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php
                    $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'success',
                        'label' => 'Ejecutar Reporte',
                        'size' => 'default',
                        'icon' => 'fa fa-file-pdf-o',
                        'buttonType' => 'submit',
                        'htmlOptions' => array('target' => '_blank;')
                    ));
                    ?>
                    <?php // echo CHtml::submitButton('Ejecutar Reporte'); ?>
                    <?php
                    $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'default',
                        'label' => 'Regresar',
                        'size' => 'default',
                        'icon' => 'fa fa-backward',
                        'buttonType' => 'link',
                        'url' => array('fACORDENCOMPR/index')
                    ));
                    ?>
                </div>
            </div>  
        </div>

    </div>
    <?php echo CHtml::endForm(); ?>
</div><!-- form -->