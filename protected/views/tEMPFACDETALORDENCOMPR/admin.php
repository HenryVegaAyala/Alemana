<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/new/jqueryui.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/new/bootstrapm.css');

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/css/new/jquery1102.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/css/new/jquery1103.js');
?>

<script language="javascript" type="text/javascript">

    function cerrar() {
        var f = document.forms[0];
        f.submit();
//        window.opener.jsload();
        setTimeout("window.close()", 1000);
    }


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

<form id='students' method='post' name='students'>

    <button type="button" id="agregarCampo" class='btn btn-success btn-sm addmore'>+ Agregar Campos de Productos</button>
    <br><br>
    <table class="table table-bordered table-condensed table-responsive table-striped table-hover table-wrapper">
        <tr>
            <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
            <th>#</th>
            <th>Descripción</th>
            <th>Codigo</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        <tr>
            <td><input type='checkbox' class='case'/></td>
            <td><span id='snum'>1</span></td>
            <td><input type="text" id='campo_DES_LARG' name='DES_LARG[]' size="45" class="form-control"/></td>
            <td><input type="text" id='campo_COD_PROD' name='COD_PROD[]' size="10" class="form-control" readonly="true"/></td>
            <td><input type="text" onchange="jsCalcular(this)"  id='campo_NRO_UNID' name='NRO_UNID[]' value="0" size="10" class="form-control" /></td>
            <td><input type="text" onchange="jsCalcular(this)"  onkeypress="jsAgregar(event);" id='campo_VAL_PREC' name='VAL_PREC[]' value="0" size="10" class="form-control" readonly="true"/> </td>
            <td><input type="text" id='campo_VAL_MONT_UNID' name='VAL_MONT_UNID[]' size="10" class="form-control" readonly="true"/> </td>
        </tr>
    </table>
    <br>
    <button type="button" class='btn btn-danger btn-sm delete'>- Eliminar</button>
    <input type="button" name="btnsubmit" value="Guardar Productos" class="btn btn-success" onclick="cerrar()"/>

    <?php
    $connection = Yii::app()->db;

//    if (isset($_POST['btnsubmit'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
    }


    $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        $('.check_all').prop("checked", false);
        check();
    });
    var i = $('table tr').length;
    $(".addmore").on('click', function() {
        count = $('table tr').length;
        var data = "<tr><td><input type='checkbox' class='case'/></td><td><span id='snum" + i + "'>" + count + ".</span></td>";
        data += '\n\\n\
                                <td>\n\
                                    <input type="text" id="DES_LARG_' + i + '" name="DES_LARG[]" size="45" class="form-control" />\n\
                                </td> \n\
                                <td>\n\
                                    <input type="text" id="COD_PROD_' + i + '" name="COD_PROD[]" size="10" class="form-control" readonly="true"/>\n\
                                </td>\n\
                                <td>\n\
                                    <input type="text" id="NRO_UNID_' + i + '" name="NRO_UNID[]" size="10" class="form-control" onchange="jsCalcular(this)" value="0" />\n\
                                </td>   \n\
                                <td>\n\
                                    <input type="text" id="VAL_PREC_' + i + '" name="VAL_PREC[]" size="10" class="form-control" onchange="jsCalcular(this)"  onkeypress="jsAgregar(event);" value="0" readonly="true"/>\n\
                                </td>\n\
                                <td>\n\
                                    <input type="text" id="campo_VAL_MONT_UNID' + i + '" name="VAL_MONT_UNID[]" size="10" class="form-control" readonly="true"/>\n\
                                </td>\n\
                                </tr>';
        $('table').append(data);
        row = i;
        $('#DES_LARG_' + i).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'ajax.php',
                    dataType: "json",
                    data: {
                        nombre_producto: request.term,
                        type: 'produc_tiend',
                        row_num: row
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
                $('#COD_PROD_' + row).val(names[1]);
                $('#NRO_UNID_' + row).val(names[2]);
                $('#VAL_PREC_' + row).val(names[3]);
            }
        });
        $('#VAL_PREC_' + i).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'ajax.php',
                    dataType: "json",
                    data: {
                        nombre_producto: request.term,
                        type: 'produc_tiend',
                        row_num: row
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            var code = item.split("|");
                            return {
                                label: code[3],
                                value: code[3],
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
                $('#COD_PROD_' + row).val(names[1]);
                $('#NRO_UNID_' + row).val(names[2]);
                $('#DES_LARG_' + row).val(names[0]);
            }
        });
        $('#NRO_UNID_' + i).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'ajax.php',
                    dataType: "json",
                    data: {
                        nombre_producto: request.term,
                        type: 'produc_tiend',
                        row_num: row
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            var code = item.split("|");
                            return {
                                label: code[2],
                                value: code[2],
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
                $('#COD_PROD_' + row).val(names[1]);
                $('#VAL_PREC_' + row).val(names[3]);
                $('#DES_LARG_' + row).val(names[0]);
            }
        });
        $('#COD_PROD_' + i).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'ajax.php',
                    dataType: "json",
                    data: {
                        nombre_producto: request.term,
                        type: 'produc_tiend',
                        row_num: row
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            var code = item.split("|");
                            return {
                                label: code[1],
                                value: code[1],
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
                $('#VAL_PREC_' + row).val(names[3]);
                $('#NRO_UNID_' + row).val(names[2]);
                $('#DES_LARG_' + row).val(names[0]);
            }
        });
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
        obj = $('table tr').find('span');
        $.each(obj, function(key, value) {
            id = value.id;
            $('#' + id).html(key + 1);
        });
    }


    $('#campo_DES_LARG').autocomplete({
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
            $('#campo_VAL_PREC').val(names[3]);
        }
    });
    $('#campo_VAL_PREC').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'ajax.php',
                dataType: "json",
                data: {
                    nombre_producto: request.term,
                    type: 'VAL_PREC',
                    row_num: 1
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[3],
                            value: code[3],
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
            $('#campo_COD_PROD').val(names[1]);
            $('#campo_NRO_UNID').val(names[2]);
            $('#campo_DES_LARG').val(names[0]);
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });
    $('#campo_COD_PROD').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'ajax.php',
                dataType: "json",
                data: {
                    nombre_producto: request.term,
                    type: 'COD_PROD',
                    row_num: 1
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[1],
                            value: code[1],
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
            $('#campo_VAL_PREC ').val(names[3]);
            $('#campo_NRO_UNID').val(names[2]);
            $('#campo_DES_LARG').val(names[0]);
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });
    $('#campo_NRO_UNID').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'ajax.php',
                dataType: "json",
                data: {
                    nombre_producto: request.term,
                    type: 'NRO_UNID',
                    row_num: 1
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[2],
                            value: code[2],
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
            $('#campo_VAL_PREC ').val(names[3]);
            $('#campo_COD_PROD ').val(names[1]);
            $('#campo_DES_LARG').val(names[0]);
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });
</script>