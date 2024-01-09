<?php
require_once('ispolnitel.php');

global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $naim_ispoln = $_POST['naim_ispoln']; 
        $INN = $_POST['INN'];
        $KPP = $_POST['KPP'];
        $Adress = $_POST['Adress'];
        $pc = $_POST['Rschet'];
        $kc = $_POST['Kschet'];
        $Bank = $_POST['Bank'];
        $BIK = $_POST['BIK'];
        $Phone = $_POST['Phone'];
          
        if (empty($naim_ispoln) || empty($INN) || empty($KPP)  || empty($Adress)  || empty($pc) || empty($kc) || empty($Bank)|| empty($BIK)|| empty($Phone)) {
                echo "Введены не все данные";
            }else{
                $sql = "INSERT INTO \"Akt_ob_okazaniji_uslug\".\"ispolnitel\" (naim_ispoln, \"INN\", \"KPP\", \"Adress\", \"Rschet\", \"Kschet\", \"Bank\", \"BIK\", \"Phone\") 
                VALUES ('$naim_ispoln', '$INN', '$KPP', '$Adress', '$pc', '$kc', '$Bank', '$BIK', '$Phone')";
                pg_query($dbconn, $sql);
                echo '<script>window.location.href = "ispolnitel.php";</script>';
        }
}
    
pg_close($dbconn);
?>