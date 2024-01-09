<?php

global $dbconn;
$dbconn = pg_connect("hostaddr=127.0.0.1 port=5433 dbname = aktuslugi user=postgres password=Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ispolnitel = $_POST['id_ispolnitel']; 
    $naim_ispoln = $_POST['naim_ispoln']; 
    $INN = $_POST['INN'];
    $KPP = $_POST['KPP'];
    $Adress = $_POST['Adress'];
    $Rschet = $_POST['Rschet'];
    $Kschet = $_POST['Kschet'];
    $Bank = $_POST['Bank'];
    $BIK = $_POST['BIK'];
    $Phone = $_POST['Phone'];

    if (empty($naim_ispoln) || empty($INN) || empty($KPP) || empty($Adress) || empty($Rschet) || empty($Kschet) || empty($Bank) || empty($BIK) || empty($Phone)) {
        echo "Введены не все данные";
    } else {

            $sql1 = "UPDATE \"Akt_ob_okazaniji_uslug\".\"ispolnitel\" 
            SET naim_ispoln = '$naim_ispoln', \"INN\" = '$INN', \"KPP\" = '$KPP', \"Adress\" = '$Adress', \"Rschet\" = '$Rschet',  \"Kschet\" = '$Kschet',  \"Bank\" = '$Bank',  \"BIK\" = '$BIK',  \"Phone\" = '$Phone'  
            WHERE \"id_ispolnitel\" = '$id_ispolnitel'";
    
            pg_query($dbconn, $sql1);
            echo '<script>window.location.href = "ispolnitel.php";</script>';
        } 
    }

pg_close($dbconn);
?>