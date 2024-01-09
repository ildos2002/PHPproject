<?php

global $dbconn;
$dbconn = pg_connect("hostaddr=127.0.0.1 port=5433 dbname=aktuslugi user=postgres password=Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shapka = $_POST['id_shapka']; 
    $FIO_ispolnit = $_POST['FIO_ispolnit']; 
    $FIO_zakaz = $_POST['FIO_zakaz'];
    $cod_org_ispolnitel = $_POST['cod_org_ispolnitel'];
    $cod_org_zakazchik = $_POST['cod_org_zakazchik'];
    $doljnost_ispolnit = $_POST['doljnost_ispolnit'];
    $doljnost_zakaz = $_POST['doljnost_zakaz'];
    if (empty($FIO_ispolnit) || empty($FIO_zakaz) || empty($cod_org_ispolnitel) || empty($cod_org_zakazchik) || empty($doljnost_ispolnit) || empty($doljnost_zakaz)) {
        echo "Введены не все данные";
    } else {

            $sql1 = "UPDATE \"Akt_ob_okazaniji_uslug\".\"shapka\" 
            SET \"FIO_ispolnit\" = '$FIO_ispolnit', \"FIO_zakaz\" = '$FIO_zakaz', \"cod_org_ispolnitel\" = '$cod_org_ispolnitel', \"cod_org_zakazchik\" = '$cod_org_zakazchik', \"doljnost_ispolnit\" = '$doljnost_ispolnit', \"doljnost_zakaz\" = '$doljnost_zakaz'
            WHERE \"id_shapka\" = '$shapka'";
    
            pg_query($dbconn, $sql1);
            echo '<script>window.location.href = "shapka.php";</script>';
        } 
    }

pg_close($dbconn);
?>