<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">
<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */

$this->breadcrumbs = array(
    'Guia' => array('index1'),
    'Buscar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facguiaremis-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Buscar Guias</h3>
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

        <div class="table-responsive">
            <?php
            $this->widget('ext.bootstrap.widgets.TbGridView', array(
                'id' => 'facguiaremis-grid',
                'type' => 'bordered condensed striped',
                'dataProvider' => $model->search(),
                'columns' => array(
                    'COD_GUIA',
                    array(
                        'name' => 'COD_ORDE',
                        'header' => 'N° de Orden',
                        'value' => '$data->cODORDE->NUM_ORDE'
                    ),
                    array(
                        'name' => 'COD_TIEN',
                        'header' => 'Tienda',
                        'value' => function($data) {
                            $tienda = $data->__GET('COD_TIEN');
                            $max = Yii::app()->db->createCommand()
                                    ->select('DES_TIEN')
                                    ->from('MAE_TIEND')
                                    ->where("COD_TIEN = '" . $tienda . "';")
                                    ->queryScalar();

                            $id = ($max);
                            return $id;
                        }
                    ),
                    array(
                        'name' => 'FEC_EMIS',
                        'header' => 'Fecha de Envio',
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_EMIS))'
                    ),
                    array(
                        'name' => 'IND_ESTA',
                        'header' => 'Estado',
                        'value' => function($data) {

                            $variable = $data->__GET('IND_ESTA');
                            switch ($variable) {
                                case 1:
                                    echo 'Emitida / Pendiente de cobro';
                                    break;
                                case 2:
                                    echo 'Cobrada / Cerrada';
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
                        'header' => 'Opciones',
                        'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                        'htmlOptions' => array('style' => 'width: 130px; text-align: center;'),
                        'template' => '{view} / {update} / {Anular} / {Factura} / {Reporte} ',
                        'buttons' => array(
                            'Anular' => array(
                                'icon' => 'trash',
                                'label' => 'Anular Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACGUIAREMIS/Anular", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2){
                                        alert ('Este N° de Guia no puede ser anulado debe estar en estado creado');
                                        return false
                                    }
                                    if(id == 9 ){
                                        alert ('Este N° de Guia ya fue Anulado');
                                        return false;
                                    }else{
                                     if (confirm ('¿ Estas Seguro de Anular la Guia ?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                            ),
                            'update' => array(
                                'icon' => 'pencil',
                                'label' => 'Actualizar Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACGUIAREMIS/update", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2 || id == 9){
                                        alert ('Este N° de Guia no puede ser actualizado debe estar en estado creado');
                                        return false
                                    }
                                     if (confirm ('¿ Estas Seguro de actualizar la Guia ?')){
                                            return true;
                                        }
                                            return false;
                                    
                               
                                }",
                            ),
                        ),
                    ),
                ),
            ));
            ?>
            <!--            <div class="panel-footer " style="overflow:hidden;text-align:right;">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
            <?php // echo CHtml::submitButton('Buscar', array('class' => 'btn btn-success btn-md'));  ?>
            
                                </div>
                            </div>  
                        </div>-->
        </div>
    </div>    
</div>