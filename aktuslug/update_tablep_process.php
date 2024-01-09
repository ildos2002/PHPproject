<?php

global $dbconn;
$dbconn = pg_connect("hostaddr=127.0.0.1 port=5433 dbname=aktuslugi user=postgres password=Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['id_table']; 
    $num_uslugi = $_POST['num_uslugi'];
    $naim_uslugi = $_POST['naim_uslugi'];
    $cost = $_POST['cost'];
    $NDS = $_POST['NDS'];
    $id_akt = $_POST['id_akt'];
    $sum = intval($cost + ($cost*($NDS/100)));
   
    if (empty($num_uslugi) || empty($naim_uslugi) || empty($cost)  || empty($NDS)  || empty($id_akt)) {
        echo "Введены не все данные";
    } else {

            $sql1 = "UPDATE \"Akt_ob_okazaniji_uslug\".\"tablep\" 
            SET num_uslugi = '$num_uslugi', naim_uslugi = '$naim_uslugi', \"cost\" = '$cost', \"NDS\" = '$NDS', \"sum_s_NDS\" = '$sum', id_akt = '$id_akt'
            WHERE \"id_table\" = '$table'";
    
            pg_query($dbconn, $sql1);
            echo '<script>window.location.href = "table.php";</script>';
        } 
    }

pg_close($dbconn);
?>