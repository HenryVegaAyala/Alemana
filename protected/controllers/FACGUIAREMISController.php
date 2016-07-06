<?php

class FACGUIAREMISController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated 
                'actions' => array('create', 'update', 'index', 'view', 
                                   'admin', 'delete', 'Lista', 'Anular', 
                    'ajax', 'Factura', 'Reporte','Anulado'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAjax() {
        if ($_GET['type'] == 'id_sele') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_ANULA_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();
        }
        
         if ($_GET['type'] == 'id_guia_factu') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_MIGRA_GUIA_TO_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();
        }
        //$this->render('index');
    }

    public function actionAnular($id) {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['FACGUIAREMIS']))
            $model->attributes = $_POST['FACGUIAREMIS'];

        $connection = Yii::app()->db;
        $usuario = Yii::app()->user->name;
        $sqlStatement = "call PED_ANULA_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $model->IND_ESTA = '9';
        $this->render('Anulado', array(
            'model' => $model,
        ));
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new FACGUIAREMIS;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FACGUIAREMIS'])) {
            $model->attributes = $_POST['FACGUIAREMIS'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_GUIA));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FACGUIAREMIS'])) {
            $model->attributes = $_POST['FACGUIAREMIS'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_GUIA));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['FACGUIAREMIS']))
            $model->attributes = $_POST['FACGUIAREMIS'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionLista($id) {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FACGUIAREMIS']))
            $model->attributes = $_GET['FACGUIAREMIS'];

        $usuario = Yii::app()->user->name;
        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_OC_TO_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $model->IND_ESTA = '0';
        $this->render('Lista', array(
            'model' => $model,
        ));
    }

    public function actionAdmin() {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FACGUIAREMIS']))
            $model->attributes = $_GET['FACGUIAREMIS'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
    public function actionReporte($id) {
        $this->render('Reporte', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionFactura($id) {


        $usuario = Yii::app()->user->name;

        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_GUIA_TO_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();
        
        $this->render('index', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function loadModel($id) {
        $model = FACGUIAREMIS::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'facguiaremis-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
