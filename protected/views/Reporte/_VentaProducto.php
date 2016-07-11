
<div class="form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Reporte de Venta</h3>
        </div>

        <?php
        $url = Yii::app()->request->baseUrl;
        echo CHtml::beginForm('' . $url . '?r=reporte/ReporteVentaProducto', 'GET', array('id' => 'reporte', 'name' => 'reporte', 'target' => '_blank'));
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

                <div class="col-sm-3 control-label">
                </div>

                <div class="col-sm-3 control-label">

                </div>                

                <div class="col-sm-3 control-label">
                </div>               
            </div>

            <div class="form-group ir">
                <div class="col-sm-3 control-label">
                </div>

                <div class="col-sm-3 control-label">
                </div>
            </div>

        </div>


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
                        'buttonType' => 'link',
//                        'htmlOptions' => array('target' => '_blank;'),
                        'url' => array('/Reporte/VentaProducto')
                    ));
                    ?>
                    <?php echo CHtml::submitButton('Ejecutar Reporte'); ?>
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