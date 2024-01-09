<?php
global $dbconn;
$dbconn = pg_connect("hostaddr=127.0.0.1 port=5433 dbname=aktuslugi user=postgres password=Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_akt = $_POST['id_akt']; 
    $shapka = $_POST['id_shapka']; 
    $akt_num = $_POST['akt_num'];
    $akt_date = date('d M y', strtotime($_POST['akt_date']));
    if (empty($shapka) || empty($akt_num) || empty($akt_date)) {
        echo "Введены не все данные";
    } else {
            $sql1 = "UPDATE \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" 
            SET id_shapka = '$shapka', akt_num = '$akt_num', akt_date = '$akt_date' 
            WHERE \"id_akt\" = '$id_akt'";
    
            pg_query($dbconn, $sql1);
            echo '<script>window.location.href = "Akt.php";</script>';
        } 
    }
pg_close($dbconn);
?>