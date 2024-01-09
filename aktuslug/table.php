<?php
$title = "Список услуг";
    require_once 'header.php';
    require_once 'delete_table.php';
    require_once 'add_table.php';
    global $dbconn;
    $dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
        or die('Не удалось соединиться: ' . pg_last_error());
    echo "<br>";
    $sql = 'SELECT * FROM "Akt_ob_okazaniji_uslug"."tablep" ORDER BY "id_table"';
    $result = pg_query($dbconn, $sql);
    echo "<table style='margin-left: 10px'>";
    echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID таблицы</th><th style='border: 1px solid black; padding: 5px;'>Номер услуги</th>
    <th style='border: 1px solid black; padding: 5px;'>Наименование услуги</th><th style='border: 1px solid black; padding: 5px;'>Цена</th><th style='border: 1px solid black; padding: 5px;'>НДС</th>
    <th style='border: 1px solid black; padding: 5px;'>Сумма с НДС</th><th style='border: 1px solid black; padding: 5px;'>ID акта</th><th>Удалить</th><th>Редактировать</th></tr>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr style='border: 1px solid black; padding: 5px;'>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['id_table'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['num_uslugi'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['naim_uslugi'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['cost'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['NDS'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['sum_s_NDS'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['id_akt'] . "</td>";
        echo "<td ><a href='delete_table.php?id_table=" . $row['id_table'] . "'><button type='submit'>Удалить</button></a></td>";
        echo "<td ><a href='update_tablep.php?id_table=" . $row['id_table'] . "'><button type='submit'>Редактировать</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<form action='add_table.php' method='POST'>";
    $sql = 'SELECT MAX("id_table") FROM "Akt_ob_okazaniji_uslug"."tablep"';
    $result = pg_query($dbconn, $sql);
    $row = pg_fetch_row($result);
    $id = $row[0] + 1;
    echo "<input type='hidden' style='margin: 3px' type='text' name='id_table' value='$id' readonly><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='num_uslugi' placeholder='Номер услуги' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='naim_uslugi' placeholder='Наименование услуги' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='cost' placeholder='Цена' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='NDS' placeholder='НДС' style='width: 300px;'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='id_akt' placeholder='ID акта' style='width: 300px;'><br>";
    echo "<input style='margin: 3px;' type='submit' value='Добавить'>";
    echo "</form>";


    pg_close($dbconn);
    ?>