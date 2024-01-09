<?php
require_once('Akt.php');
global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());
    if(isset($_GET['id_akt'])) {
        $id = $_GET['id_akt'];
    $sql = "DELETE FROM \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" WHERE \"id_akt\" = '$id'";
    $result = pg_query($dbconn, $sql);
    echo '<script>window.location.href = "Akt.php";</script>';
    }  
 pg_close($dbconn);
?>