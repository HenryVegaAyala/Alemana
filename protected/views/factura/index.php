<?php
/* @var $this FacturaController */
/* @var $model Factura */


$this->breadcrumbs = array(
    'Factura' => array('index'),
    'Administración',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#factura-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Búsqueda Factura</h3>
            </div>
            <div class="mar">
                <?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
            </div>
            <div class="search-form" style="display:none">
                <?php $this->renderPartial('_search', array(
                    'model' => $model,
                )); ?>
            </div>
            <!-- search-form -->

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'action' => Yii::app()->createUrl($this->route),
                'method' => 'post',
            ));
            ?>

            <div class="table-responsive">

                <?php
                $this->widget('ext.bootstrap.widgets.TbGridView', array(
                    'id' => 'facfactu-grid',
                    'type' => 'bordered condensed striped',
                    'id' => 'factura-grid',
                    'dataProvider' => $model->search(),
                    'columns' => array(
                        array(
                            'id' => 'COD_FACT',
                            'class' => 'CCheckBoxColumn',
                            'selectableRows' => '50',
                        ),
                        array(
                            'name' => 'COD_FACT',
                            'header' => 'N° Factura',
                            'value' => '$data->COD_FACT'
                        ),
                        /* array(
                             'name' => 'COD_CLIE',
                             'header' => 'Cliente',
                             'value' => function ($data) {
                                 $model = new Factura();
                                 $variable = $data->__GET('COD_TIEN');
                                 echo $model->getCliente($variable);
                             },
                         ),*/
                        array(
                            'name' => 'FEC_FACT',
                            'header' => 'Fecha de Factura',
                            'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_FACT))'
                        ),
                        array(
                            'name' => 'FEC_PAGO',
                            'header' => 'Fecha de Pago',
                            'value' => function ($data) {

                                $variable = $data->__GET('FEC_PAGO');
                                if ($variable == null) {
                                    echo 'Fecha Indefinida';
                                } else {
                                    echo Yii::app()->dateFormatter->format("dd/MM/y", strtotime($data->FEC_PAGO));
                                }
                            },
                        ),
                        array(
                            'name' => 'IND_ESTA',
                            'header' => 'Estado',
                            'value' => function ($data) {

                                $variable = $data->__GET('IND_ESTA');
                                switch ($variable) {
                                    case 1:
                                        echo 'Emitida/Pendiente de Cobro';
                                        break;
                                    case 2:
                                        echo 'Cobrada/Cerrada';
                                        break;
                                    case 9:
                                        echo 'Anulado';
                                        break;
                                    case 0:
                                        echo 'Creado';
                                        break;
                                }
                            },
                        ),
                        array(
                            'name' => 'COD_GUIA',
                            'header' => 'N° Guia',
                            'value' => '$data->COD_GUIA'
                        ),
                        array(
                            'name' => 'COD_GUIA',
                            'header' => 'N° O/C',
                            'value' => function ($data) {
                                $model = new Factura();
                                $variable = $data->__GET('COD_FACT');
                                echo $model->getOC($variable);
                            }
                        ),
                        'TOT_FACT',
                        array(
                            'header' => 'Opciones',
                            'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                            'htmlOptions' => array('style' => 'width: 101px; text-align: center;'),
                            'template' => '{view} / {update} / {Anular} / {Reporte}',
                            'buttons' => array(

                                'update' => array(
                                    'icon' => 'pencil',
                                    'label' => 'Actualizar Factura',
                                    'htmlOptions' => array('style' => 'width: 50px'),
                                    'url' => 'Yii::app()->controller->createUrl("/factura/update", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
                                    'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 2 || id == 9){
                                        alert ('Este N° de Factura no puede ser actualizado debe estar en estado creado');
                                        return false
                                    }
                                     if (confirm ('¿ Estas Seguro de actualizar la Factura ?')){
                                            return true;
                                        }
                                            return false;
                                    
                               
                                }",
                                ),

                                'Anular' => array(
                                    'icon' => 'trash',
                                    'label' => 'Anular Factura',
                                    'htmlOptions' => array('style' => 'width: 50px'),
                                    'url' => 'Yii::app()->controller->createUrl("/factura/Anular", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
                                    'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 2){
                                        alert ('Este N° de Factura no puede ser anulado debe estar en estado emitido');
                                        return false
                                    }
                                    if(id == 9 ){
                                        alert ('Este N° de Factura ya fue Anulado');
                                        return false;
                                    }else{
                                     if (confirm ('¿ Estas Seguro de Anular la Factura ?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                                ),

                                'Reporte' => array(
                                    'icon' => 'fa fa-file-pdf-o',
                                    'label' => 'Generar PDF Factura',
                                    'htmlOptions' => array('style' => 'width: 50px',),
                                    'options' => array('target' => '_blank'),
                                    'url' => 'Yii::app()->controller->createUrl("/factura/reporte", array("id"=>$data->COD_FACT))',
                                ),

                            ),
                        ),
                    ),
                ));
                ?>
                <div class="panel-footer " style="overflow:hidden;text-align:right;">
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-11">
                            <?php
                            $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                                'context' => 'default',
                                'label' => 'Refrescar Lista Facturas',
                                'size' => 'default',
                                'icon' => 'refresh',
                                'buttonType' => 'link',
                                'url' => array('/factura/index')
                            ));
                            ?>

                            <?php
                            $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                                'context' => 'default',
                                'label' => 'Imprimir Facturas Masivas',
                                'size' => 'default',
                                'icon' => 'fa fa-print fa-lg',
                                'buttonType' => 'link',
                                'htmlOptions' => array(
                                    'onclick' => 'doSomething(); return false;',
                                    'target' => '_blank;'),
                                'url' => array('/factura/index')
                            ));
                            ?>
                            <?php
                            $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                                'context' => 'default',
                                'label' => 'Imprimir Facturas Masivas Continua',
                                'size' => 'default',
                                'icon' => 'fa fa-print fa-lg',
                                'buttonType' => 'link',
                                'htmlOptions' => array(
                                    'onclick' => 'doSomething1(); return false;',
                                    'target' => '_blank;'),
                                'url' => array('/factura/index')
                            ));
                            ?>
                            <?php
                            $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                                'context' => 'default',
                                'label' => 'Generar Excel de Factura',
                                'size' => 'default',
                                'icon' => 'fa fa-file-excel-o fa-lg',
                                'buttonType' => 'link',
                                'url' => array('REPORTE/Factura')
                            ));
                            ?>

                            <script>
                                function doSomething() {

                                    var item = $("form input:checkbox:checked");
                                    if (item.length == 0) {
                                        alert('Debe seleccionar las Facturas que requiere imprimir');
                                        return false;
                                    }
                                    // alert('Plese select checkbox! ' + item.length);
                                    idfactu = '';
                                    hayUltimo = false;
                                    for (i = item.length - 1; i >= 0; i--) {
                                        if (item[0].value == '1') {
                                            hayUltimo = true;
                                        }

                                        if (item[i].value != '1')
                                            idfactu = idfactu + item[i].value;

                                        if (i - 1 > 0 && hayUltimo) {
                                            idfactu = idfactu + '_';
                                        }

                                        if (i - 1 >= 0 && !hayUltimo) {
                                            idfactu = idfactu + '_';
                                        }

                                    }

                                    hhref = 'ajax1.php?type=id_factu&id=' + idfactu;
                                    window.open(hhref, '_blank');
                                    return false;
                                }
                            </script>

                            <script>
                                function doSomething1() {

                                    var item = $("form input:checkbox:checked");
                                    if (item.length == 0) {
                                        alert('Debe seleccionar las Facturas que requiere imprimir');
                                        return false;
                                    }
                                    // alert('Plese select checkbox! ' + item.length);
                                    idfactu = '';
                                    hayUltimo = false;
                                    for (i = item.length - 1; i >= 0; i--) {

                                        if (item[0].value == '1') {
                                            hayUltimo = true;
                                        }

                                        if (item[i].value != '1')
                                            idfactu = idfactu + item[i].value;

                                        if (i - 1 > 0 && hayUltimo) {
                                            idfactu = idfactu + '_';
                                        }

                                        if (i - 1 >= 0 && !hayUltimo) {
                                            idfactu = idfactu + '_';
                                        }

                                    }


                                    hhref = 'ajax2.php?type=id_factu&id=' + idfactu;
                                    window.open(hhref, '_blank');
                                    return false;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $this->endWidget(); ?>