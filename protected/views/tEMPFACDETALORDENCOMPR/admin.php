<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/new/jqueryui.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/new/bootstrapm.css');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/css/new/jquery1102.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/css/new/jquery1103.js');
?>

<script language="javascript" type="text/javascript">

//    function cerrar() {
//        var f = document.forms[0];
//        f.submit();
////        window.opener.jsload();
//        setTimeout("window.close()", 1000);
//    }


    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type == "text")) {

            return false;
        }
    }
    document.onkeypress = stopRKey;

    function jsAgregar(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        if (evt.keyCode == 13) {
            //alert ('Has pulsado enter');
            var AddButton = $("#agregarCampo");
            //alert ('Has pulsado enter '+AddButton);
            AddButton.click();
        }
    }
</script>


<?php
$usuario = Yii::app()->user->name;

$ip = getenv("REMOTE_ADDR");
$pc = @gethostbyaddr($ip);

$pcip = $pc . ' - ' . $ip;


Yii::app()->session['PCIP'] = $pcip;
Yii::app()->session['USU'] = $usuario;
?>

<html>

    <button type="button" id="agregarCampo" class='btn btn-success btn-sm addmore'>+ Agregar Campos de Productos</button>
    <button type="button" class='btn btn-danger btn-sm delete'>- Eliminar</button>
    <br><br>
    <table class="table table-bordered table-condensed table-responsive table-striped table-hover table-wrapper" id="tableP">
        <tr>
            <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
            <th>#</th>
            <th>Descripción</th>
            <th>Codigo</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
<!--        <tr>
            <td><input type='checkbox' class='case'/></td>
            <td><span id='snum'>1</span></td>
            <td><input type="text" id='DES_LARG' name='DES_LARG[]' size="45" class="form-control"/></td>
            <td><input type="text" id='campo_COD_PROD' name='COD_PROD[]' size="10" class="form-control" readonly="true"/></td>
            <td><input type="text" onchange="jsCalcular(this)"  id='campo_NRO_UNID' name='NRO_UNID[]' value="0" size="10" class="form-control" /></td>
            <td><input type="text" onchange="jsCalcular(this)"  onkeypress="jsAgregar(event);" id='campo_VAL_PREC' name='VAL_PREC[]' value="0" size="10" class="form-control"/> </td>
            <td><input type="text" id='campo_VAL_MONT_UNID' name='VAL_MONT_UNID[]' size="10" class="form-control" readonly="true"/> </td>
        </tr>-->
    </table>
    <br>

    <?php
//    $connection = Yii::app()->db;
//
////    if (isset($_POST['btnsubmit'])) {
//    if ($_SERVER['REQUEST_METHOD'] == "POST") {
//        $CODPRO = $_POST['COD_PROD'];
//        $DESCRI = $_POST['DES_LARG'];
//        $UND = $_POST['NRO_UNID'];
//        $VALPRE = $_POST['VAL_PREC'];
//        $VALMOTUND = $_POST['VAL_MONT_UNID'];
//
//        for ($i = 0; $i < count($CODPRO); $i++) {
//            
//                   
//            if($CODPRO[$i] <> ''){
//             $sqlStatement = "call prueba('" . $CODPRO[$i] . "', '" . $UND[$i] . "','" . $VALPRE[$i] . "', '" . $VALMOTUND[$i] . "','" . $DESCRI[$i] . "','" . $usuario . "','" . $pcip . "')";
//             $command = $connection->createCommand($sqlStatement);
//             $command->execute();
//            }
//        }
//    }
    ?>
</html>



<script>

    function redondear2decimales(numero)
    {
        var original = parseFloat(numero);
        var result = Math.round(original * 100) / 100;
        return result;
    }



    function jsCalcular(ele) {

        var arr_uni = document.getElementsByName("NRO_UNID[]");
        var arr_pre = document.getElementsByName("VAL_PREC[]");
        var arr_total = document.getElementsByName("VAL_MONT_UNID[]");
        for (var x = 0; x < arr_uni.length; x++) {

            cantidad = parseFloat(arr_uni[x].value, 2);
            precunit = parseFloat(arr_pre[x].value, 2);
            totalitem = parseFloat((precunit * cantidad), 2);
            arr_total[x].value = redondear2decimales(totalitem);
        }
        
        sumaSubTotal=eval(0);
         for (var x = 0; x < arr_total.length; x++) {
             sumaSubTotal = parseFloat(sumaSubTotal,2) + parseFloat(arr_total[x].value,2);
         }
         //alert(sumaSubTotal);
         montoIGV =  parseFloat(parseFloat(sumaSubTotal,2)* parseFloat(eval(0.18),2) , 2);
         total = parseFloat(sumaSubTotal,2)+parseFloat(montoIGV,2);
         
         document.getElementById("FACORDENCOMPR_TOT_MONT_ORDE").value =redondear2decimales(sumaSubTotal);
         document.getElementById("FACORDENCOMPR_TOT_MONT_IGV").value =redondear2decimales(montoIGV);
         document.getElementById("FACORDENCOMPR_TOT_FACT").value =redondear2decimales(total);
    }


    $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        $('.check_all').prop("checked", false);
        check();
    });
    var i = $('#tableP tr').length;
    $(".addmore").on('click', function() {

        //debe validar que no se ingrese registros duplicados
        var x = document.getElementsByName("COD_PROD[]");
        primeraFila = 0;
        ultimaFila = x.length - 1;
        //i=x.length+1;
        //Calucalr Total/Subotal/IGV


        for (k = 0; k <= ultimaFila; k++) {
            cod = x[k].value;
            for (j = k + 1; j <= ultimaFila; j++) {
                cod2 = x[j].value;
                // alert(cod + ' - '+cod2);
                if (cod === cod2) {
                    alert("Existen codigos de productos duplicados xx, por favor revisar");
                    return;
                }
            }
        }

        count = $('#tableP tr').length;
        //alert(count);
        var data = "<tr><td><input type='checkbox' class='case'/></td><td><span id='snum" + i + "'>" + count + "</span></td>";
        data += '\n\\n\
                                <td>\n\
                                    <input type="text" id="DES_LARG_' + i + '" name="DES_LARG[]" size="45" class="form-control" />\n\
                                </td> \n\
                                <td>\n\
                                    <input type="text" id="COD_PROD_' + i + '" name="COD_PROD[]" size="10" class="form-control" readonly="true"/>\n\
                                </td>\n\
                                <td>\n\
                                    <input type="text" id="NRO_UNID_' + i + '" name="NRO_UNID[]" size="10" class="form-control" onchange="jsCalcular(this)"  onkeyup="jsCalcular(this);"  value="0" />\n\
                                </td>   \n\
                                <td>\n\
                                    <input type="text" id="VAL_PREC_' + i + '" name="VAL_PREC[]" size="10" class="form-control" onchange="jsCalcular(this)"  onkeyup="jsCalcular(this);" onkeypress="jsAgregar(event);" value="0"/>\n\
                                </td>\n\
                                <td>\n\
                                    <input type="text" id="campo_VAL_MONT_UNID' + i + '" name="VAL_MONT_UNID[]" size="10" class="form-control" readonly="true"/>\n\
                                </td>\n\
                                </tr>';
        $('#tableP').append(data);

        crearFunciones(i);
        i++;
    });
    function select_all() {
        $('input[class=case]:checkbox').each(function() {
            if ($('input[class=check_all]:checkbox:checked').length == 0) {
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        });
    }

    function check() {
//        obj = $('#tableP tr').find('span');
//        $.each(obj, function(key, value) {
//            id = value.id;
//            alert(id)
//            $('#' + id).html(key + 1);
//        });
    }

    function crearFunciones(i) {
        //  for(i=0; i< fila;i++){
        //alert('crearFunciones '+i);
        row = i;
        $('#DES_LARG_' + i).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'ajax.php',
                    dataType: "json",
                    data: {
                        nombre_producto: request.term,
                        type: 'produc_tiend',
                        row_num: 2
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            //alert(item)
                            var code = item.split("|");
                            return {
                                label: code[0],
                                value: code[0],
                                data: item
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 0,
            select: function(event, ui) {
                var names = ui.item.data.split("|");
                console.log(names[1], names[2], names[3]);
                $('#COD_PROD_' + row).val(names[1]);
                $('#NRO_UNID_' + row).val(names[2]);
                $('#VAL_PREC_' + row).val(names[3]);
            }
        });
    }

    $('#DES_LARG').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'ajax.php',
                dataType: "json",
                data: {
                    nombre_producto: request.term,
                    type: 'produc_tiend',
                    row_num: 1
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[0],
                            value: code[0],
                            data: item
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0,
        select: function(event, ui) {
            var names = ui.item.data.split("|");
            console.log(names[1], names[2], names[3]);
            $('#campo_COD_PROD').val(names[1]);
            $('#campo_NRO_UNID').val(names[2]);
            $('#campo_VAL_PREC ').val(names[3]);
        }


    });
</script>