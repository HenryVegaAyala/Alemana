<?php

$conn = mysqli_connect('sispaal.cnjv4vhhy3or.us-west-2.rds.amazonaws.com', 'root', 'root2016', 'SIS_PANA', '3306');
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');

if ($_POST) {
    $q = $_POST['search'];
    $sql_res = mysqli_query($conn, "SELECT des_larg,COD_PROD FROM MAE_PRODU where des_larg like '%$q%' order by des_larg asc;");
    while ($row = mysqli_fetch_array($sql_res)) {
        $username = $row['des_larg'];
        $email = $row['COD_PROD'];
        $b_username = '<strong>' . $q . '</strong>';
        $b_email = '<strong>' . $q . '</strong>';
        $final_username = str_ireplace($q, $b_username, $username);
        $final_email = str_ireplace($q, $b_email, $email);
        ?>
        <div class="show" align="left">
            <!--<img src="author.PNG" style="width:50px; height:50px; float:left; margin-right:6px;" />-->
            <span class="name"><?php echo $final_username; ?></span>&nbsp;<br/><?php echo $final_email; ?><br/>
        </div>
        <?php
    }
}
mysqli_close($conn);
?>
