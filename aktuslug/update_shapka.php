<?php
$title = "Обновление записи";
require_once 'header.php';
global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!") or die('Не удалось соединиться: ' . pg_last_error());

// Получение идентификатора акта из GET-параметра
if(isset($_GET['id_shapka'])) {
$id_shapka = $_GET['id_shapka'];

// Получение данных акта из базы данных
$sql = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"shapka\" AS shapka WHERE shapka.id_shapka = $id_shapka";
$result = pg_query($dbconn, $sql);
$row = pg_fetch_assoc($result);
echo "<script>
            function goBack() {
                  window.history.back();
                }
              </script>";
// Отображение формы обновления записи
echo "<button style='margin-left: 10px' class='print-hide' onclick='goBack()'>Назад</button>";
echo "<form action='update_shapka_process.php' method='POST'>";
echo "<table style='margin-left: 10px'>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID шапки</th><th><input style='margin: 3px' type='text' name='id_shapka' value='" . $row['id_shapka'] . "'readonly></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ФИО исполнителя</th><th><input style='margin: 3px' type='text' name='FIO_ispolnit' value='" . $row['FIO_ispolnit'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ФИО заказчика</th><th><input style='margin: 3px' type='text' name='FIO_zakaz' value='" . $row['FIO_zakaz'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Код организации-исполнителя</th><th><input style='margin: 3px' type='text' name='cod_org_ispolnitel' value='" . $row['cod_org_ispolnitel'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Код организации-заказчика</th><th><input style='margin: 3px' type='text' name='cod_org_zakazchik' value='" . $row['cod_org_zakazchik'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Должность исполнителя</th><th><input style='margin: 3px' type='text' name='doljnost_ispolnit' value='" . $row['doljnost_ispolnit'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>Должность заказчика</th><th><input style='margin: 3px' type='text' name='doljnost_zakaz' value='" . $row['doljnost_zakaz'] . "'></th><tr>";
echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'><input style='margin: 3px' type='submit' value='Редактировать'></th><tr>";
echo "</table>";
echo "</form>";
}

pg_close($dbconn);
?>