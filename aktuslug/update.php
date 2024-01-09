<?php
$title = "Редактирование записи";
require_once 'header.php';
global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!") or die('Не удалось соединиться: ' . pg_last_error());
if(isset($_GET['id_akt'])) {
$id_akt = $_GET['id_akt'];
$sql = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" AS akt WHERE akt.id_akt = $id_akt";
$result = pg_query($dbconn, $sql);
$row = pg_fetch_assoc($result);
echo "<script>
            function goBack() {
                  window.history.back();
                }
              </script>";
echo "<button style='margin-left: 10px' class='print-hide' onclick='goBack()'>Назад</button>";
echo "<form action='update_process.php' method='POST'>";
echo "<table style='margin-left: 10px'>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID акта</th><th><input style='margin: 3px' type='text' name='id_akt' value='" . $row['id_akt'] . "'readonly></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID шапки</th><th><input style='margin: 3px' type='text' name='id_shapka' value='" . $row['id_shapka'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Номер акта</th><th><input style='margin: 3px' type='text' name='akt_num' value='" . $row['akt_num'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Дата акта</th><th><input style='margin: 3px' type='date' name='akt_date' value='" . $row['akt_date'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'><input style='margin: 3px' type='submit' value='Редактировать'></th><tr>";
echo "</table>";
echo "</form>";
}
pg_close($dbconn);
?>