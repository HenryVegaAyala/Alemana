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
        
    }

}
