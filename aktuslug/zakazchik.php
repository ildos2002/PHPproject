<?php
$title = "Заказчики";
    require_once 'header.php';
    require_once 'delete_zakaz.php';
    require_once 'add_zakaz.php';
    global $dbconn;
    $dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
        or die('Не удалось соединиться: ' . pg_last_error());
    echo "<br>";
    $sql = 'SELECT * FROM "Akt_ob_okazaniji_uslug"."zakazchik" ORDER BY "id_zakazchik"';
    $result = pg_query($dbconn, $sql);
    echo "<table style='margin-left: 10px'>";
    echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID заказчика</th><th style='border: 1px solid black; padding: 5px;'>Наименование заказчика</th>
    <th style='border: 1px solid black; padding: 5px;'>ИНН</th><th style='border: 1px solid black; padding: 5px;'>КПП</th>
    <th style='border: 1px solid black; padding: 5px;'>Адрес</th><th style='border: 1px solid black; padding: 5px;'>Р/с</th>
    <th style='border: 1px solid black; padding: 5px;'>К/с</th><th style='border: 1px solid black; padding: 5px;'>Банк</th>
    <th style='border: 1px solid black; padding: 5px;'>БИК</th><th style='border: 1px solid black; padding: 5px;'>Телефон</th><th>Удалить</th><th>Редактировать</th></tr>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr style='border: 1px solid black; padding: 5px;'>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['id_zakazchik'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['naim_zakaz'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['INN'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['KPP'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['Adress'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['Rschet'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['Kschet'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['Bank'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['BIK'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['Phone'] . "</td>";
        echo "<td ><a href='delete_zakaz.php?id_zakazchik=" . $row['id_zakazchik'] . "'><button type='submit'>Удалить</button></a></td>";
        echo "<td ><a href='update_zakaz.php?id_zakazchik=" . $row['id_zakazchik'] . "'><button type='submit'>Редактировать</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<form action='add_zakaz.php' method='POST'>";
    $sql = 'SELECT MAX("id_zakazchik") FROM "Akt_ob_okazaniji_uslug"."zakazchik"';
    $result = pg_query($dbconn, $sql);
    $row = pg_fetch_row($result);
    $id = $row[0] + 1;
    echo "<input type='hidden' style='margin: 3px' type='text' name='id_zakazchik' value='$id' style='width: 100px;' readonly><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='naim_zakaz' placeholder='Наименование заказчика' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='INN' placeholder='ИНН' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='KPP' placeholder='КПП' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='Adress' placeholder='Адрес' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='Rschet' placeholder='Р/с' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='Kschet' placeholder='К/с' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='Bank' placeholder='Банк' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='BIK' placeholder='БИК' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='Phone' placeholder='Телефон' style='width: 300px;'><br>";
    echo "<input style='margin: 3px' type='submit' value='Добавить'>";
    echo "</form>";

    pg_close($dbconn);
    ?>