
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV3.css">

<?php
$usuario = Yii::app()->user->name;

$ip = getenv("REMOTE_ADDR");
$pc = @gethostbyaddr($ip);

$pcip = $pc . ' - ' . $ip;

Yii::app()->session['USU'] = $usuario;
Yii::app()->session['PCIP'] = $pcip;
?>

<a  id="agregarCampo" class="btn btn-link alt" >+ Agregar Campos de Productos</a>

<form method="post" >
    <div id="contenedor">
        <div class="contenedor">

            <table>
                <thead>
                    <tr>
                        <th class="center">Codigo de Producto&nbsp&nbsp</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Descripción &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Cantidad</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Precio</th>
                        <th class="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Total</th>
                    </tr>
                </thead>
            </table>


            <input type="text" name="COD_PROD[]" id="campo_COD_PROD" />
            <input type="text" name="DES_LARG[]" id="campo_DES_LARG" />
            <input type="text" name="NRO_UNID[]" id="campo_NRO_UNID" />
            <input type="text" name="VAL_PREC[]" id="campo_VAL_PREC"  />
            <input type="text" name="VAL_MONT_UNID[]" id="campo_VAL_MONT_UNID" />

            <a href="#" class="eliminar alt2" >Eliminar &times;</a>
        </div>
    </div>

    <input type="submit" name="submit" value="Guardar Productos" class="btn btn-success"/>

    <?php
    $connection = Yii::app()->db;

    if (isset($_POST['submit'])) {

        $nombre = $_POST['COD_PROD'];
        $apellido = $_POST['DES_LARG'];
        $carrera = $_POST['NRO_UNID'];
        $ciclo = $_POST['VAL_PREC'];
        $ponderado = $_POST['VAL_MONT_UNID'];

        for ($i = 0; $i < count($nombre); $i++) {
            $sqlStatement = "call prueba('" . $nombre[$i] . "', '" . $carrera[$i] . "','" . $ciclo[$i] . "', '" . $ponderado[$i] . "','" . $apellido[$i] . "','" . $usuario . "','" . $pcip . "')";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();
        }
    }
    ?>

</form>

<script>
    $(document).ready(function () {

        var MaxInputs = 50; //Número Maximo de Campos
        var contenedor = $("#contenedor"); //ID del contenedor
        var AddButton = $("#agregarCampo"); //ID del Botón Agregar
        //var x = número de campos existentes en el contenedor
        var x = $("#contenedor div").length + 1;
        var FieldCount = x - 1; //para el seguimiento de los campos

        $(AddButton).click(function (e) {
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++;
                //agregar campo
                $(contenedor).append(
                        '<div>\n\
\n\                     <input type="text" name="COD_PROD[]" id="campo_DES_LARG_' + FieldCount + '" placeholder="Texto ' + FieldCount + '"/>\n\
\n\                     <input type="text" name="DES_LARG[]" id="campo_NRO_UNID_' + FieldCount + '"/>\n\
\n\                     <input type="text" name="NRO_UNID[]" id="campo_VAL_PREC_' + FieldCount + '"/>\n\
\n\                     <input type="text" name="VAL_PREC[]" id="campo_VAL_MONT_UNID_' + FieldCount + '"/>\n\
\n\                     <input type="text" name="VAL_MONT_UNID[]" id="campo_VAL_MONT_UNID_' + FieldCount + '""/>\n\
                        <a href="#" class="eliminar alt2" >Eliminar &times;</a></div>'
                        );

                x++; //text box increment
            }
            return false;
        });

        $("body").on("click", ".eliminar", function (e) { //click en eliminar campo
            if (x > 1) {
                $(this).parent('div').remove(); //eliminar el campo
                x--;
            }
            return false;
        });
    });
</script>
