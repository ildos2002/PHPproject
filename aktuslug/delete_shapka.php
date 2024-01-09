<?php
require_once('shapka.php');

global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

    if(isset($_GET['id_shapka'])) {
        $id = $_GET['id_shapka'];


    $sql = "DELETE FROM \"Akt_ob_okazaniji_uslug\".\"shapka\" WHERE \"id_shapka\" = '$id'";
    $result = pg_query($dbconn, $sql);
    echo '<script>window.location.href = "shapka.php";</script>';
    }
    
 pg_close($dbconn);
?>