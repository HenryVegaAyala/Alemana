<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
<center>
    <h1>Bienvenido a Panadería Pastelería Alemana</h1>
</center>
<br>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    
<!--    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>-->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <center>
                <img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/android-chrome-192x192.png' ?>">
            </center>
            <div class="carousel-caption">
                ...
            </div>
        </div>
        <div class="item">
            <center>
                <img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/android-chrome-192x192.png' ?>">
            </center>
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
<br>
