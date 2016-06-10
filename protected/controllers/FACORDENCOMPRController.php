<?php

class FACORDENCOMPRController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public $clie;

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view', 'admin', 'delete', 'ClienteByTienda', 'ValorTienda', 'search', 'Respaldo', 'ajax'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSearch() {
        $this->render('/tEMPFACDETALORDENCOMPR/search');
    }

    public function actionAjax() {

        if ($_GET['type'] == 'produc_tiend') {
            $row_num = $_GET['row_num'];
            $connection = Yii::app()->db;
            $sqlStatement = "SELECT DES_LARG,COD_PROD,NRO_UNID,VAL_PROD  FROM MAE_PRODU where DES_LARG LIKE '" . strtoupper($_GET['nombre_producto']) . "%'";
            $command = $connection->createCommand($sqlStatement);
            $reader = $command->query();
            $data = array();
            while ($row = $reader->read()) {
                $name = $row['DES_LARG'] . '|' . $row['COD_PROD'] . '|' . $row['NRO_UNID'] . '|' . $row['VAL_PROD'] . '|' . $row_num;
                array_push($data, $name);
            }
            echo json_encode($data);
        }
    }

    public function actionRespaldo() {
        $this->render('/tEMPFACDETALORDENCOMPR/Respaldo');
    }

    public function actionClienteByTienda() {
        $model = new FACORDENCOMPR;
        $COD = $_POST["FACORDENCOMPR"]["NUM_ORDE"];
        $clie = $_POST["FACORDENCOMPR"]["COD_CLIE"];
        $list = MAETIEND::model()->findAll("COD_CLIE = ?", array($_POST["FACORDENCOMPR"]["COD_CLIE"]));
        echo "<option value=\"\">Seleccionar Tienda</option>";
        foreach ($list as $data)
            echo "<option value=\"{$data->COD_TIEN}\">{$data->DES_TIEN}</option>";

        Yii::app()->session['CODIGO'] = $COD;
    }

    public function actionValorTienda() {
        $clie = $_POST["FACORDENCOMPR"]["COD_CLIE"];
        $tienda = $_POST["FACORDENCOMPR"]["COD_TIEN"];
//          echo "{$clie}." - ".{$tienda}";

        $connection = Yii::app()->db;
        $sqlStatement = "Select MC.NRO_RUC,MC.DES_CLIE,MT.DIR_TIEN from MAE_CLIEN MC, MAE_TIEND MT where  MC.COD_CLIE = MT.COD_CLIE and MT.COD_ESTA = 1 and MC.COD_ESTA = 1 and MC.COD_CLIE = $clie and MT.COD_TIEN = $tienda;";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();

        foreach ($reader as $row)
            echo $row['NRO_RUC'];
        echo "/";
        echo $row['DES_CLIE'];
        echo "/";
        echo $row['DIR_TIEN'];
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
        $model = new FACORDENCOMPR;
        $modelOC = new TEMPFACDETALORDENCOMPR();
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['FACORDENCOMPR'])) {
            $model->attributes = $_POST['FACORDENCOMPR'];
            if ($model->save())
                $this->redirect(array('index', 'id' => $model->COD_ORDE), Yii::app()->session['USU'] = " ");
        }

        $this->render('create', array(
            'model' => $model,
            'modelOC' => $modelOC,
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

        if (isset($_POST['FACORDENCOMPR'])) {
            $model->attributes = $_POST['FACORDENCOMPR'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_ORDE));
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
        $model = new FACORDENCOMPR('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FACORDENCOMPR']))
            $model->attributes = $_GET['FACORDENCOMPR'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new FACORDENCOMPR('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FACORDENCOMPR']))
            $model->attributes = $_GET['FACORDENCOMPR'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return FACORDENCOMPR the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = FACORDENCOMPR::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param FACORDENCOMPR $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'facordencompr-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
?>