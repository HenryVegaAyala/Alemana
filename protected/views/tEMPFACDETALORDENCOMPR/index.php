<!--[if lte IE 6]>
<script type="text/javascript" src="js/supersleight-min.js"></script>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('a.poplight[href^=#]').click(function () {
            var popID = $(this).attr('rel');
            var popURL = $(this).attr('href');
            var query = popURL.split('?');
            var dim = query[1].split('&');
            var popWidth = dim[0].split('=')[1];
            $('#' + popID).fadeIn().css({'width': Number(popWidth)}).prepend('<a href="#" class="close"><img src="imagenes/cerrarpopup.jpg" class="btn_close" title="Cerrar" alt="Cerrar" /></a>');
            var popMargTop = ($('#' + popID).height() + 80) / 2;
            var popMargLeft = ($('#' + popID).width() + 80) / 2;
            $('#' + popID).css({
                'margin-top': -popMargTop,
                'margin-left': -popMargLeft
            });
            $('body').append('<div id="fade"></div>');
            $('#fade').css({'filter': 'alpha(opacity=80)'}).fadeIn();

            return false;
        });
        $('a.close, #fade').live('click', function () {
            $('#fade , .popup_block').fadeOut(function () {
                $('#fade, a.close').remove();
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".tab_content").hide();
        $("ul.tabs li:first").addClass("active").show();
        $(".tab_content:first").show();
        $("ul.tabs li").click(function () {
            $("ul.tabs li").removeClass("active");
            $(this).addClass("active");
            $(".tab_content").hide();
            var activeTab = $(this).find("a").attr("href");
            $(activeTab).fadeIn();
            return false;
        });
    });
</script>
</head>

<body>

    <div class="tab_container">
        <!-- Vinos Tintos -->
        <div id="vinos_tintos" class="tab_content">
            <div class="titulos_productos"><img src="imagenes/titulo_vinostintos.png" width="117" height="24" alt="Vinos Tintos" /></div>
            <?php include("tintos.php"); ?>
        </div>
        <!-- Vinos Blancos -->
        <div id="vinos_blancos" class="tab_content">
            <div class="titulos_productos"><img src="imagenes/titulo_vinosblancos.png" width="139" height="24" alt="Vinos Blancos" /></div>
            <?php include("blancos.php"); ?>
        </div>
        <!-- Vinos Rosados -->
        <div id="vinos_rosados" class="tab_content">
            <div class="titulos_productos"><img src="imagenes/titulo_vinosrosados.png" width="138" height="24" alt="Vinos Rosados" /></div>
            <?php include("rosados.php"); ?>
        </div>
        <!-- Vinos Espumantes -->
        <div id="vinos_espumantes" class="tab_content">
            <div class="titulos_productos"><img src="imagenes/titulo_vinosespumantes.png" width="170" height="34" alt="Vinos Espumantes" /></div>
            <?php include("espumantes.php"); ?>
        </div>
        <!-- Whisky -->
        <div id="whisky" class="tab_content">
            <div class="titulos_productos"><img src="imagenes/titulo_whisky.png" width="76" height="32" alt="Whisky" /></div>
            <?php include("whisky.php"); ?>
        </div>
        <!-- Destilados y Aperitivos -->
        <div id="destilados_aperitivos" class="tab_content">
            <div class="titulos_productos"><img src="imagenes/titulo_destiladosaperitivos.png" width="231" height="37" alt="Destilados y Aperitivos" /></div>
                <?php include("destilados.php"); ?>
        </div>
    </div>                  
</div>

</body>
</html>