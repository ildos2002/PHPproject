<?php
$title = "Обновление записи";
require_once 'header.php';
global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!") or die('Не удалось соединиться: ' . pg_last_error());

// Получение идентификатора акта из GET-параметра
if(isset($_GET['id_table'])) {
$id_table = $_GET['id_table'];

// Получение данных акта из базы данных
$sql = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"tablep\" AS tablep WHERE tablep.id_table = $id_table";
$result = pg_query($dbconn, $sql);
$row = pg_fetch_assoc($result);
echo "<script>
            function goBack() {
                  window.history.back();
                }
              </script>";
// Отображение формы обновления записи
echo "<button style='margin-left: 10px' class='print-hide' onclick='goBack()'>Назад</button>";
echo "<form action='update_tablep_process.php' method='POST'>";
echo "<table style='margin-left: 10px'>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID таблицы</th><th><input style='margin: 3px' type='text' name='id_table' value='" . $row['id_table'] . "'readonly></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Номер услуги</th><th><input style='margin: 3px' type='text' name='num_uslugi' value='" . $row['num_uslugi'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Наименование услуги</th><th><input style='margin: 3px' type='text' name='naim_uslugi' value='" . $row['naim_uslugi'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Цена</th><th><input style='margin: 3px' type='text' name='cost' value='" . $row['cost'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>НДС</th><th><input style='margin: 3px' type='text' name='NDS' value='" . $row['NDS'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID акта</th><th><input style='margin: 3px' type='text' name='id_akt' value='" . $row['id_akt'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'><input style='margin: 3px' type='submit' value='Редактировать'></th><tr>";
echo "</table>";
echo "</form>";
}

pg_close($dbconn);
?>