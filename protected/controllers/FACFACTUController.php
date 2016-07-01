<?php

class FACFACTUController extends Controller {
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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated 
                'actions' => array('create', 'update', 'index', 'view',
                    'admin', 'delete', 'Anular', 'Reporte',
                    'Ajax','Lista'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionLista($id) {
        $model = new FACFACTU('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FACFACTU']))
            $model->attributes = $_GET['FACFACTU'];

        $usuario = Yii::app()->user->name;
        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_GUIA_TO_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $this->render('Lista', array(
            'model' => $model,
        ));
    }

    public function actionAnular($id) {

        $connection = Yii::app()->db;
        $usuario = Yii::app()->user->name;
        $sqlStatement = "call PED_ANULA_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $this->render('index', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionAjax() {
        if ($_GET['type'] == 'id_sele') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_ANULA_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();
        }
        $this->render('index');
    }

    public function actionReporte($id) {
        $this->render('Reporte', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new FACFACTU;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FACFACTU'])) {
            $model->attributes = $_POST['FACFACTU'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_FACT));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FACFACTU'])) {
            $model->attributes = $_POST['FACFACTU'];

            $model->IND_ESTA = '2';

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_FACT));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new FACFACTU('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FACFACTU']))
            $model->attributes = $_GET['FACFACTU'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new FACFACTU('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FACFACTU']))
            $model->attributes = $_GET['FACFACTU'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return FACFACTU the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = FACFACTU::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param FACFACTU $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'facfactu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
