
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV3.css">

<script language="javascript">
    function cerrar() {
        window.opener.jsload();
        setTimeout("window.close();", 1000);
    }

    
    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) ) {
            var AddButton = document.getElementById("#agregarCampo");
                alert("GOl");
            AddButton.onclick()
            return false;
        }
    }
    document.onkeypress = stopRKey;

</script>

<?php
$usuario = Yii::app()->user->name;

$ip = getenv("REMOTE_ADDR");
$pc = @gethostbyaddr($ip);

$pcip = $pc . ' - ' . $ip;


Yii::app()->session['PCIP'] = $pcip;
Yii::app()->session['USU'] = $usuario;
?>

<a  id="agregarCampo" class="btn btn-link alt" >+ Agregar Campos de Productos</a>

<form name="form1" method="post" >
    <div id="contenedor">
        <div class="contenedor">

            <table>
                <thead>
                    <tr>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp  Descripción &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Codigo &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Cantidad</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Precio</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Total</th>
                    </tr>
                </thead>
            </table>

            <input type="text" name="DES_LARG[]" id="campo_DES_LARG" />
            <input type="text" name="COD_PROD[]" id="campo_COD_PROD" readonly="true"/>
            <input type="text" onchange="jsCalcular(this)" name="NRO_UNID[]" id="campo_NRO_UNID" value="0"/>
            <input type="text" onchange="jsCalcular(this)" name="VAL_PREC[]" id="campo_VAL_PREC"  value="0"/>
            <input type="text"  name="VAL_MONT_UNID[]" id="campo_VAL_MONT_UNID" readonly="true" />

            <a href="#" class="eliminar alt2" >Eliminar &times;</a>
        </div>
    </div>

    <input type="submit" name="submit" value="Guardar Productos" class="btn btn-success" onclick="cerrar()"/>

    <?php
    $connection = Yii::app()->db;

    if (isset($_POST['submit'])) {

        $CODPRO = $_POST['COD_PROD'];
        $DESCRI = $_POST['DES_LARG'];
        $UND = $_POST['NRO_UNID'];
        $VALPRE = $_POST['VAL_PREC'];
        $VALMOTUND = $_POST['VAL_MONT_UNID'];

        for ($i = 0; $i < count($CODPRO); $i++) {
            $sqlStatement = "call prueba('" . $CODPRO[$i] . "', '" . $UND[$i] . "','" . $VALPRE[$i] . "', '" . $VALMOTUND[$i] . "','" . $DESCRI[$i] . "','" . $usuario . "','" . $pcip . "')";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();
        }
    }
    ?>

</form>

<script>

    function jsCalcular(ele) {

        var arr_uni = document.getElementsByName("NRO_UNID[]");
        var arr_pre = document.getElementsByName("VAL_PREC[]");
        var arr_total = document.getElementsByName("VAL_MONT_UNID[]");

//        alert("HOl " + arr_uni.length);

//        var cantidad = 0, precunit = 0, totalitem = 0;
//        var tr = ele.parentNode.parentNode;
//        var nodes = tr.childNodes;

//        alert(nodes.length);
        for (var x = 0; x < arr_uni.length; x++) {
//            alert(arr_uni[x].value);


            cantidad = parseFloat(arr_uni[x].value, 10);

            precunit = parseFloat(arr_pre[x].value, 10);


            totalitem = parseFloat((precunit * cantidad), 10);
            arr_total[x].value = totalitem;

        }
    }



    $(document).ready(function() {

        var MaxInputs = 50; //Número Maximo de Campos
        var contenedor = $("#contenedor"); //ID del contenedor
        var AddButton = $("#agregarCampo"); //ID del Botón Agregar
        //var x = número de campos existentes en el contenedor
        var x = $("#contenedor div").length + 1;
        var FieldCount = x - 1; //para el seguimiento de los campos

        $(AddButton).click(function(e) {
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++;
                //agregar campo
                $(contenedor).append(
                        '<div>\n\
\n\                     <input type="text" name="DES_LARG[]" id="campo_DES_LARG_' + FieldCount + '"/>\n\
\n\                     <input type="text" readonly="true" name="COD_PROD[]" id="campo_NRO_UNID_' + FieldCount + '"/>\n\
\n\                     <input type="text" onchange="jsCalcular(this)" name="NRO_UNID[]"  value="0" id="campo_VAL_PREC_' + FieldCount + '"/>\n\
\n\                     <input type="text" onchange="jsCalcular(this)" name="VAL_PREC[]" value="0" id="campo_VAL_MONT_UNID_' + FieldCount + '"/>\n\
\n\                     <input type="text" name="VAL_MONT_UNID[]" id="campo_VAL_MONT_UNID_' + FieldCount + '""/>\n\
                        <a href="#" class="eliminar alt2" >Eliminar &times;</a></div>'
                        );

                x++; //text box increment
            }
            return false;
        });

        $("body").on("click", ".eliminar", function(e) { //click en eliminar campo
            if (x > 1) {
                $(this).parent('div').remove(); //eliminar el campo
                x--;
            }
            return false;
        });
    });
</script>
