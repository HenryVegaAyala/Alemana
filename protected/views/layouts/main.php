<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="es" charset="UTF-8">
        <meta description="http://iconogen.com/ and http://fontawesome.io and http://www.w3schools.com/ and http://www.jqwidgets.com/ and http://www.favicon-generator.org/">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/icon/css/font-awesome.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body class="body">

        <div class="container">
            <div>
                <?php
                $this->widget(
                        'booster.widgets.TbNavbar', array(
                    'type' => 'inverse',
                    'collapse' => true, // requires bootstrap-responsive.css 
                    'fluid' => true,
                    'brand' => 'Panadería Alemana',
//                    'brand' => '<img src ="' . Yii::app()->request->baseUrl . '/images/lg.png" />' . " Panadería Alemana",
//                    'fixed' => false,
                    'items' => array(
                        array(
                            'class' => 'booster.widgets.TbMenu',
                            'type' => 'navbar',
                            'items' => array(
                                array('label' => 'Inicio', 'url' => array('/site/index'), 'visible' => Yii::app()->user->isGuest),
                                array(
                                    'label' => 'O/C',
                                    'items' => array(
                                        array('label' => 'Registrar O/C', 'url' => array('/fACORDENCOMPR/create')),
                                        array('label' => 'Listar O/C', 'url' => array('/fACORDENCOMPR/index')),
                                        '---',
                                    ), 'visible' => !Yii::app()->user->isGuest
                                ),
                                array(
                                    'label' => 'Guía',
                                    'items' => array(
                                        array('label' => 'Listar Guia', 'url' => array('/FACGUIAREMIS/index')),
                                        '---',
//                                        array('label' => 'Reportes', 'url' => array('/site/contact')),
                                    ), 'visible' => !Yii::app()->user->isGuest
                                ),
                                array(
                                    'label' => 'Factura',
                                    'items' => array(
                                        array('label' => 'Listar Factura', 'url' => array('/FACFACTU/index')),
                                        '---',
//                                        array('label' => 'Reportes', 'url' => array('/site/contact')),
                                    ), 'visible' => !Yii::app()->user->isGuest
                                ),
                                array(
                                    'label' => 'Reporte Venta',
                                    'items' => array(
                                        array('label' => 'Top Venta', 'url' => array('/REPORTE/VentaProducto')),
                                        '---',
//                                        array('label' => 'Reportes', 'url' => array('/site/contact')),
                                    ), 'visible' => !Yii::app()->user->isGuest
                                ),
//                                array(
//                                    'label' => 'Usuario',
//                                    'items' => array(
//                                        array('label' => 'Registrar', 'url' => array('/site/register')),
//                                        array('label' => 'Cambiar Contraseña', 'url' => array('/site/change')),
//                                    ), 'visible' => !Yii::app()->user->isGuest
//                                ),
//                                array(
//                                    'label' => 'Cliente',
//                                    'items' => array(
//                                        array('label' => 'Registrar Cliente', 'url' => array('/mAECLIEN/create')),
//                                        array('label' => 'Lista de Clientes', 'url' => array('/mAECLIEN/index')),
//                                        '---',
//                                        array('label' => 'Registrar Tienda', 'url' => array('/mAETIEND/create')),
//                                        array('label' => 'Lista de Tienda', 'url' => array('/mAETIEND/index')),
//                                        
//                                    ), 'visible' => !Yii::app()->user->isGuest
//                                ),
//                                array('label' => 'Acerca', 'url' => array('/site/page', 'view' => 'about'), 'visible' => !Yii::app()->user->isGuest),
//                                array('label' => 'Pruebas', 'url' => array('/fACORDENCOMPR/view'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Iniciar Sesión', 'icon' => 'fa fa-user fa-lg', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Cerrar Sesión (' . Yii::app()->user->name . ')', 'icon' => 'fa fa-user-times fa-lg', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                            ),
                        )
                    )
                        )
                );
                ?>
            </div>

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('ext.bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

        </div><!-- page -->
    <center>
        <div id="footer">

            Copyright &copy; <?php echo date('Y'); ?> Derechos Reservados por Panadería Alemana.

        </div>  
        <br>
    </center>
</body>
</html>
