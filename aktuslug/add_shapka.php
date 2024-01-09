<?php
require_once('shapka.php');

global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $FIO_ispolnit = $_POST['FIO_ispolnit']; 
        $FIO_zakaz = $_POST['FIO_zakaz'];
        $cod_org_ispolnitel = $_POST['cod_org_ispolnitel'];
        $cod_org_zakazchik = $_POST['cod_org_zakazchik'];
        $doljnost_ispolnit = $_POST['doljnost_ispolnit'];
        $doljnost_zakaz = $_POST['doljnost_zakaz'];
          
        if (empty($FIO_ispolnit) || empty($FIO_zakaz) || empty($cod_org_ispolnitel)  || empty($cod_org_zakazchik) || empty($doljnost_ispolnit)  || empty($doljnost_zakaz)) {
                echo "Введены не все данные";
            }else{
                $sql = "INSERT INTO \"Akt_ob_okazaniji_uslug\".\"shapka\" (\"FIO_ispolnit\", \"FIO_zakaz\", \"cod_org_ispolnitel\", \"cod_org_zakazchik\", \"doljnost_ispolnit\", \"doljnost_zakaz\") 
                VALUES ('$FIO_ispolnit', '$FIO_zakaz', '$cod_org_ispolnitel', '$cod_org_zakazchik', '$doljnost_ispolnit', '$doljnost_zakaz')";
                pg_query($dbconn, $sql);
                echo '<script>window.location.href = "shapka.php";</script>';
        }
}
    
pg_close($dbconn);
?>