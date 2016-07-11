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
                'actions' => array('Factura', 'VentaProducto', 'ReporteVentaProducto'),
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

        $this->renderPartial('_ReporteVentaProducto', array(
            'Fecha_Ini' => $Fecha_Ini,
            'Fecha_Fin' => $Fecha_Fin,
            'Cod_Clie' => $Cod_Clie,
            'Cod_Tiend' => $Cod_Tiend,
            'Estado' => $Estado,
                )
        );
    }

}
