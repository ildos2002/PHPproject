<?php
$title = "Акт об оказании услуг";
    require_once 'header.php';
    require_once 'delete.php';
    require_once 'add.php';
    global $dbconn;
    $dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
        or die('Не удалось соединиться: ' . pg_last_error());
    echo "<br>";
    $sql = 'SELECT * FROM "Akt_ob_okazaniji_uslug"."Akt_ob_okazaniji_uslug" ORDER BY "id_akt"';
    $result = pg_query($dbconn, $sql);
    echo "<table style='margin-left: 10px'>";
    echo "<tr style='background: lightblue'><th style='border: 1px solid black; padding: 5px;'>ID акта</th><th style='border: 1px solid black; padding: 5px;'>ID шапки</th>
    <th style='border: 1px solid black; padding: 5px;'>Номер акта</th><th style='border: 1px solid black; padding: 5px;'>Дата составления</th><th>Удалить</th><th>Редактировать</th><th>Отчет</th></tr>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr style='border: 1px solid black; padding: 5px;'>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['id_akt'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['id_shapka'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['akt_num'] . "</td>";
        echo "<td style='border: 1px solid black; padding: 5px;'>" . $row['akt_date'] . "</td>";
        echo "<td ><a href='delete.php?id_akt=" . $row['id_akt'] . "'><button type='submit'>Удалить</button></a></td>";
        echo "<td ><a href='update.php?id_akt=" . $row['id_akt'] . "'><button type='submit'>Редактировать</button></a></td>";
        echo "<td><a href='otchet.php?id_akt=" . $row['id_akt'] . "&id_shapka=" . $row['id_shapka'] . "&akt_num=" . $row['akt_num'] .  "&akt_date=" . $row['akt_date'] . "'><button type='submit'>Отчет</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<form action='add.php' method='POST'>";
    $sql = 'SELECT MAX("id_akt") FROM "Akt_ob_okazaniji_uslug"."Akt_ob_okazaniji_uslug"';
    $result = pg_query($dbconn, $sql);
    $row = pg_fetch_row($result);
    $id = $row[0] + 1;
    echo "<input type='hidden' style='margin: 3px' name='id_akt' value='$id'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='id_shapka' placeholder='ID шапки'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='text' name='akt_num' placeholder='Номер акта'><br>";
    echo "<input style='margin: 3px; width: 600px;' type='date' name='akt_date' placeholder='Дата составления' pattern='d{2} [A-Za-z]{3} d{2}'><br>";
    echo "<input style='margin: 3px;' type='submit' value='Добавить'>";
    echo "</form>";
    pg_close($dbconn);
    ?>