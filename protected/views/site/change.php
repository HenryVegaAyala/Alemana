<?php
/* @var $this SiteController */
/* @var $model ChangeForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Cambiar Contraseña';
$this->breadcrumbs = array(
    'Cambiar Contraseña',
);
?>

<div class="row">
    <div class="col-md-12">
        <h1><p class="text-center">Cambiar Contraseña</p></h1>
    </div>
</div>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="alert">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif ?>


<div class="form-horizontal">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="container-fluid " style="text-align: center;">

        <div class="form-group">
            <div class="col-xs-7 col-sm-2 col-md-2 col-lg-2 control-label">
                <?php echo $form->labelEx($model, 'password'); ?>
            </div>
            <div class="col-xs-5 col-sm-7 col-md-6 col-lg-6">
                <?php echo $form->textField($model, 'password', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'password'); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-7 col-sm-2 col-md-2 col-lg-2 control-label">
                <?php echo $form->labelEx($model, 'password_new', array('class' => 'form-label')); ?>
            </div>
            <div class="col-xs-5 col-sm-7 col-md-6 col-lg-6">
                <?php echo $form->passwordField($model, 'password_new', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'password_new'); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-7 col-sm-2 col-md-2 col-lg-2 control-label">
                <?php echo $form->labelEx($model, 'password_new_repeat', array('class' => 'form-label')); ?>
            </div>
            <div class="col-xs-5 col-sm-7 col-md-6 col-lg-6">
                <?php echo $form->passwordField($model, 'password_new_repeat', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'password_new_repeat'); ?>
            </div>
        </div>

        <div class="form-group buttons">
            <div class="controls">
                <?php echo CHtml::submitButton('Cambiar Contraseña', array('class' => 'btn btn-primary', 'icon' => 'ICON_HEART')); ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
