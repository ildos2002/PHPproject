<?php
require_once('ispolnitel.php');

global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

    if(isset($_GET['id_ispolnitel'])) {
        $id = $_GET['id_ispolnitel'];


    $sql = "DELETE FROM \"Akt_ob_okazaniji_uslug\".\"ispolnitel\" WHERE \"id_ispolnitel\" = '$id'";
    $result = pg_query($dbconn, $sql);
    echo '<script>window.location.href = "ispolnitel.php";</script>';
    }
    
 pg_close($dbconn);
?>