<?php

class REPORTEController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated 
                'actions' => array('Factura', 'VentaProducto', 'ReporteVentaProducto', 'LoadCliente'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionFactura() {
        $this->renderPartial('_Factura');
    }

    public function actionVentaProducto() {
        $this->render('_VentaProducto');
    }

    public function actionReporteVentaProducto() {
        $Fecha_Ini = $_POST['Fecha_Ini'];
        $Fecha_Fin = $_POST['Fecha_Fin'];
        $Cod_Clie = $_POST['Cod_Clie'];
        $Cod_Tiend = $_POST['Cod_Tiend'];
        $Estado = $_POST['Estado'];
        $Agrupa = $_POST['Agrupa'];
        $Usuario = Yii::app()->user->name;

        $connection = Yii::app()->db;
        $sqlStatement = "call PED_GENER_REPOR_VENTA('" . $Fecha_Ini . "' ,'" . $Fecha_Fin . "','" . $Cod_Clie . "','" . $Cod_Tiend . "','" . $Estado . "','" . $Agrupa . "','" . $Usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $this->renderPartial('_ReporteVentaProducto', array(
            'Fecha_Ini' => $Fecha_Ini,
            'Fecha_Fin' => $Fecha_Fin,
            'Cod_Clie' => $Cod_Clie,
            'Cod_Tiend' => $Cod_Tiend,
            'Estado' => $Estado,
            'Agrupa' => $Agrupa,
            'Usuario' => $Usuario,
                )
        );
    }

    public function actionLoadCliente() {

//        $data = MAETIEND::model()->findAllBySql(
//                "SELECT COD_CLIE,DES_TIEN FROM mae_tiend m 
//                    where COD_CLIE =:keyword or COD_CLIE = '0' 
//                    order by COD_CLIE = '0' desc, DES_TIEN asc;", 
//                array(':keyword' => $_POST['Cod_Clie']));
//        $data = CHtml::listData($data, 'COD_CLIE', 'DES_TIEN');
//        foreach ($data as $value => $name) {
//            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
//        }

        $list = MAETIEND::model()->findAll("COD_CLIE = ?", array($_POST["Cod_Clie"]));
        echo "<option value=\"\">Seleccionar Tienda</option>";
        foreach ($list as $data)
            echo "<option value=\"{$data->COD_TIEN}\">{$data->DES_TIEN}</option>";
    }

}
