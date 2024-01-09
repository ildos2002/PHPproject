<?php
require_once('table.php');

global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $num_uslugi = $_POST['num_uslugi']; 
        $naim_uslugi = $_POST['naim_uslugi'];
        $cost = intval($_POST['cost']);
        $NDS = intval($_POST['NDS']);
        $sum = intval($cost + ($cost*($NDS/100)));
        $id_akt = $_POST['id_akt'];
          
        if (empty($num_uslugi) || empty($naim_uslugi) || empty($cost)  || empty($NDS)  || empty($id_akt)) {
                echo "Введены не все данные";
            }else{
                $sql = "INSERT INTO \"Akt_ob_okazaniji_uslug\".\"tablep\" (num_uslugi, naim_uslugi, cost, \"NDS\", \"sum_s_NDS\", id_akt) 
                VALUES ('$num_uslugi', '$naim_uslugi', '$cost', '$NDS', '$sum', '$id_akt')";
                pg_query($dbconn, $sql);
                echo '<script>window.location.href = "table.php";</script>';
        }
}
    
pg_close($dbconn);
?>