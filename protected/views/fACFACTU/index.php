<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'post',
        ));
?>

<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */

$this->breadcrumbs = array(
    'Factura' => array('index'),
    'Buscar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facfactu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda Factura</h3>
        </div>

        <div class="mar">
            <?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
           
        </div>

        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div><!-- search-form -->
        <div class="mar">
             <?php echo CHtml::link('Imprimir Facturas Masivas', "javascript:;", array(
                'style' => 'cursor: pointer;',
                'target'=>'_blank;',
                "onclick" => "doSomething(); return false;"
            ));
            ?>
        </div>
        <div class="table-responsive">
            <?php
            $this->widget('ext.bootstrap.widgets.TbGridView', array(
                'id' => 'facfactu-grid',
                'type' => 'bordered condensed striped',
                'dataProvider' => $model->search(),
                'columns' => array(
                    array(
                        'id' => 'COD_FACT',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    'COD_FACT',
                    'COD_GUIA',
                    array(
                        'name' => 'COD_CLIE',
                        'header' => 'Cliente',
                        'value' => '$data->cODCLIE->DES_CLIE'
                    ),
                    array(
                        'name' => 'FEC_FACT',
                        'header' => 'Fecha Facturado',
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_FACT))'
                    ),
                    array(
                        'name' => 'FEC_PAGO',
                        'header' => 'Fecha de Pago',
                        'value' => function($data) {

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
                        'value' => function($data) {

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
                    'TOT_FACT',
                    array(
                        'header' => 'Opciones',
                        'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                        'htmlOptions' => array('style' => 'width: 130px; text-align: center;'),
                        'template' => '{view} / {update} / {Anular} / {Reporte}',
                        'buttons' => array(
                            'update' => array(
                                'icon' => 'pencil',
                                'label' => 'Actualizar Factura',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACFACTU/update", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
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
                                'url' => 'Yii::app()->controller->createUrl("/FACFACTU/Anular", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
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
                                'icon' => 'file',
                                'label' => 'Generar PDF Factura',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACFACTU/Reporte", array("id"=>$data->COD_FACT))',
                            ),
                        ),
                    ),
                ),
            ));
            ?>
            <div class="panel-footer " style="overflow:hidden;text-align:right;">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Refrescar Lista Facturas',
                            'size' => 'default',
                            'icon' => 'refresh',
                            'buttonType' => 'link',
                            'url' => array('/FACFACTU/index')
                        ));
                        ?>

                    
                        <script>
                            function doSomething() {

                                var item = $("form input:checkbox:checked");
                              if(item.length == 0){
                                    alert('Debe seleccionar las Facturas que requiere imprimir');
                                    return false;
                                }
                                // alert('Plese select checkbox! ' + item.length);
                                idfactu='';
                                for (i = 0; i < item.length; i++) {
                                  if( (i+1) == item.length){//si es el ultimo elemento
                                    idfactu= idfactu + item[i].value;  
                                  } else{
                                    if(item[i].value != '1'){  
                                     idfactu= idfactu + item[i].value+ '_';
                                    }
                                  }                    
                               }
                               
                               hhref ='ajax.php?type=id_factu&id='+idfactu;
                               window.open(hhref, '_blank');
                             
//                                    $.ajax({
//                                        url: 'ajax.php',
//                                        dataType: "json",
//                                        
//                                        data: {
//                                            type: 'id_factu',
//                                            id: idfactu  //item[i].value
//                                        },
//                                        succes: function (data) {
//
//                                            response($.map(data, function (item) {
//
//                                                alert(item);
//                                                return {
//                                                    label: item,
//                                                    value: item,
//                                                    data: item
//                                                }
//                                            }));
//
//
//                                        }
//                                    });
                                

                                return false;
                            }
                        </script>
                    </div>
                </div>    
            </div>        
        </div>
    </div>
</div>    
<?php $this->endWidget(); ?>