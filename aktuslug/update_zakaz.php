<?php
$title = "Обновление записи";
require_once 'header.php';
global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!") or die('Не удалось соединиться: ' . pg_last_error());

// Получение идентификатора акта из GET-параметра
if(isset($_GET['id_zakazchik'])) {
$id_zakazchik = $_GET['id_zakazchik'];

// Получение данных акта из базы данных
$sql = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"zakazchik\" AS zakazchik WHERE zakazchik.id_zakazchik = $id_zakazchik";
$result = pg_query($dbconn, $sql);
$row = pg_fetch_assoc($result);
echo "<script>
            function goBack() {
                  window.history.back();
                }
              </script>";
// Отображение формы обновления записи
echo "<button style='margin-left: 10px' class='print-hide' onclick='goBack()'>Назад</button>";
echo "<form action='update_zakaz_process.php' method='POST'>";
echo "<table style='margin-left: 10px'>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID заказчика</th><th><input style='margin: 3px' type='text' name='id_zakazchik' value='" . $row['id_zakazchik'] . "'readonly></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Наименование заказчика</th><th><input style='margin: 3px' type='text' name='naim_zakaz' value='" . $row['naim_zakaz'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ИНН</th><th><input style='margin: 3px' type='text' name='INN' value='" . $row['INN'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>KPP</th><th><input style='margin: 3px' type='text' name='KPP' value='" . $row['KPP'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Адрес</th><th><input style='margin: 3px' type='text' name='Adress' value='" . $row['Adress'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Р/с</th><th><input style='margin: 3px' type='text' name='Rschet' value='" . $row['Rschet'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>К/с</th><th><input style='margin: 3px' type='text' name='Kschet' value='" . $row['Kschet'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Банк</th><th><input style='margin: 3px' type='text' name='Bank' value='" . $row['Bank'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>БИК</th><th><input style='margin: 3px' type='text' name='BIK' value='" . $row['BIK'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Телефон</th><th><input style='margin: 3px' type='text' name='Phone' value='" . $row['Phone'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'><input style='margin: 3px' type='submit' value='Редактировать'></th><tr>";
echo "</table>";
echo "</form>";
}

pg_close($dbconn);
?>