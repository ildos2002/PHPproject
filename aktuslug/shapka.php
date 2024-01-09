<?php
$title = "Шапка документа";
    require_once 'header.php';
    require_once 'delete_shapka.php';
    require_once 'add_shapka.php';
    global $dbconn;
    $dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
        or die('Не удалось соединиться: ' . pg_last_error());
    echo "<br>";
    $sql = 'SELECT * FROM "Akt_ob_okazaniji_uslug"."shapka" ORDER BY "id_shapka"';
    $result = pg_query($dbconn, $sql);
    echo "<table style='margin-left: 10px'>";
    echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID шапки</th><th style='border: 1px solid black; padding: 5px;'>ФИО исполнителя</th>
    <th style='border: 1px solid black; padding: 5px;'>ФИО заказчика</th><th style='border: 1px solid black; padding: 5px;'>Код организации-исполнителя</th><th style='border: 1px solid black; padding: 5px;'>Код организации-заказчика</th>
    <th style='border: 1px solid black; padding: 5px;'>Должность исполнителя</th><th style='border: 1px solid black; padding: 5px;'>Должность заказчика</th><th>Удалить</th><th>Редактировать</th></tr>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr style='border: 1px solid black; padding: 5px;'>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['id_shapka'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['FIO_ispolnit'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['FIO_zakaz'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['cod_org_ispolnitel'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['cod_org_zakazchik'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['doljnost_ispolnit'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['doljnost_zakaz'] . "</td>";
        echo "<td ><a href='delete_shapka.php?id_shapka=" . $row['id_shapka'] . "'><button type='submit'>Удалить</button></a></td>";
        echo "<td ><a href='update_shapka.php?id_shapka=" . $row['id_shapka'] . "'><button type='submit'>Редактировать</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<form action='add_shapka.php' method='POST'>";
    $sql = 'SELECT MAX("id_shapka") FROM "Akt_ob_okazaniji_uslug"."shapka"';
    $result = pg_query($dbconn, $sql);
    $row = pg_fetch_row($result);
    $id = $row[0] + 1;
    echo "<input type='hidden' style='margin: 3px' type='text' name='id_shapka' value='$id' style='width: 100px;' readonly><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='FIO_ispolnit' placeholder='ФИО исполнителя' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='FIO_zakaz' placeholder='ФИО заказчика' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='cod_org_ispolnitel' placeholder='Код организации-исполнителя' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='cod_org_zakazchik' placeholder='Код организации-заказчика' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='doljnost_ispolnit' placeholder='Должность исполнителя' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='doljnost_zakaz' placeholder='Должность заказчика' style='width: 300px;'><br>";
    echo "<input style='margin: 3px;' type='submit' value='Добавить'>";
    echo "</form>";

    pg_close($dbconn);
    ?>