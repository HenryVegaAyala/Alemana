<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login/animate-custom.css">

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="container" id="login-block">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">

                <div class="login-box clearfix animated flipInY">
                    <div class="login-logo">
                        <center>
                            <a href=""><img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/apple-icon-144x144.png' ?>"></a>
                        </center>
                    </div> 

                    <div class="login-form">

                        <?php echo $form->textField($model, 'username', array('maxlength' => 10, 'class' => 'form-control', 'placeholder' => 'Usuario', 'required' => true)); ?>

                        <?php echo $form->passwordField($model, 'password', array('maxlength' => 10, 'class' => 'form-control', 'placeholder' => 'Contraseña', 'required' => true)); ?>

                        <button type="submit" name="btn-login" class="btn btn-block btn-red">
                            <i class="glyphicon glyphicon-log-in"></i>&nbsp;Inicia Sesión
                        </button>


                        <div class="login-links"> 
                            <a href="">¿Recupera tu cuenta? <strong>INGRESA AQUÍ</strong>
                            </a>
                        </div>      		
                    </div> 			        	
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
