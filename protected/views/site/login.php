<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/animate-custom.css">

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
                        <a href="#"><img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/apple-icon-144x144.png' ?>"></a>
                    </center>
                </div> 

                <div class="login-form">
                    <div class="alert alert-error hide">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Error!</h4>
                        Your Error Message goes here
                    </div>

                    <form  method="post"  >
                        <?php // echo $form->labelEx($model, 'username'); ?>
                        <?php echo $form->textField($model, 'username'); ?>
                        <?php echo $form->error($model, 'username'); ?>
                        
                                <?php // echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>

                        <button type="submit" name="btn-login" class="btn btn-block btn-red">
                            <i class="glyphicon glyphicon-log-in"></i>&nbsp;Inicia Sesión
                        </button>
                        <?php echo CHtml::submitButton('Iniciar Sesión'); ?>
                         </form>

                    <div class="login-links"> 
                        <a href="sign-up.html">¿No tienes cuenta? <strong>INICIA SESIÓN</strong>
                        </a>
                    </div>      		
                </div> 			        	
            </div>
        </div>
    </div>
</div>
    <?php $this->endWidget(); ?>
</div>