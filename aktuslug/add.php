<?php
require_once('Akt.php');
global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $shapka = $_POST['id_shapka']; 
        $akt_num = $_POST['akt_num'];
        $akt_date = date('d M y', strtotime($_POST['akt_date']));
        if (empty($shapka) || empty($akt_num) || empty($akt_date) ) {
                echo "Введены не все данные";
            }else{
                $sql = "INSERT INTO \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" (id_shapka, akt_num, akt_date) 
                VALUES ('$shapka', '$akt_num', '$akt_date')";
                pg_query($dbconn, $sql);
                echo '<script>window.location.href = "Akt.php";</script>';
        }
}
pg_close($dbconn);
?>