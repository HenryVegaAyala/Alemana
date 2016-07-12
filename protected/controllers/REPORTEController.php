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
        $Fecha_Ini = $_GET['Fecha_Ini'];
        $Fecha_Fin = $_GET['Fecha_Fin'];
        $Cod_Clie = $_GET['Cod_Clie'];
        $Cod_Tiend = $_GET['Cod_Tiend'];
        $Estado = $_GET['Estado'];
        $Agrupa = $_GET['Agrupa'];
        $Usuario = Yii::app()->user->name;
        
        $dateIn = Yii::app()->dateFormatter->format("y-MM-dd", strtotime($Fecha_Ini));
        $dateFi = Yii::app()->dateFormatter->format("y-MM-dd", strtotime($Fecha_Fin));

        $connection = Yii::app()->db;
        $sqlStatement = "call PED_GENER_REPOR_VENTAs ('" . $dateIn . "' ,'" . $dateFi . "','" . $Cod_Clie . "','" . $Cod_Tiend . "','" . $Estado . "','" . $Agrupa . "','" . $Usuario . "') ;";
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
//                array(':keyword' => $_GET['Cod_Clie']));
//        $data = CHtml::listData($data, 'COD_CLIE', 'DES_TIEN');
//        foreach ($data as $value => $name) {
//            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
//        }

        $list = MAETIEND::model()->findAll("COD_CLIE = ?", array($_GET["Cod_Clie"]));
        echo "<option value=\"\">Seleccionar Tienda</option>";
        foreach ($list as $data)
            echo "<option value=\"{$data->COD_TIEN}\">{$data->DES_TIEN}</option>";
    }

}
