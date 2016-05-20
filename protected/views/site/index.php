<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
<center>
    <h1>Bienvenido a Panadería Pastelería Alemana</h1>
</center>
<br>

<?php
$this->widget(
        'booster.widgets.TbCarousel', array(
    'items' => array(
        array(
            'image' => ('images/ms-icon-310x310.png'),
            'label' => 'First Thumbnail label',
            'caption' => 'First Caption.'
        ),
        array(
            'image' => ('images/ms-icon-310x310.png'),
            'label' => 'Second Thumbnail label',
            'caption' => 'Cras justo odio, dapis ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
        ),
        array(
            'image' => ('images/ms-icon-310x310.png'),
            'label' => 'Third Thumbnail label',
            'caption' => 'Cras justo odio, dapis ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
        ),
    ),
        )
);

echo '<br>';
echo '<br>';
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <center>
                <img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/pagina-en-construccion.gif' ?>">
            </center>
            <div class="carousel-caption">
                ...
            </div>
        </div>
        <div class="item">
            <img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/pagina-en-construccion.gif' ?>">
            <div class="carousel-caption">
                ...
            </div>
        </div>
        ...
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>