<?php

global $dbconn;
$dbconn = pg_connect("hostaddr = 127.0.0.1 port = 5433 dbname = aktuslugi user = postgres password = Qwerty2002!")
    or die('Не удалось соединиться: ' . pg_last_error());


    if(isset($_GET['id_akt'])) {
        $id = $_GET['id_akt'];
        $shapka = intval($_GET['id_shapka']);
        $ispolnitel = $_GET['id_ispolnitel'];
        $zakazchik = $_GET['id_zakazchik'];
        $akt_num = $_GET['akt_num'];
        $akt_date = $_GET['akt_date'];

        $sql1 = "SELECT akt_num, akt_date FROM \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" AS akt WHERE akt.id_akt = '$id'";
        $result1 = pg_query($dbconn, $sql1);

        $sql2 = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"shapka\" AS shapka,
        \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" AS akt, \"Akt_ob_okazaniji_uslug\".\"ispolnitel\" AS ispolnitel, \"Akt_ob_okazaniji_uslug\".\"zakazchik\" AS zakazchik 
        WHERE akt.id_akt = '$id' AND akt.id_shapka = shapka.id_shapka AND shapka.cod_org_ispolnitel = ispolnitel.id_ispolnitel AND shapka.cod_org_zakazchik = zakazchik.id_zakazchik";
        $result2 = pg_query($dbconn, $sql2);

        $sql3 = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"tablep\" AS tablep,
        \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" AS akt WHERE akt.id_akt = '$id' AND tablep.id_akt = akt.id_akt";
        $result3 = pg_query($dbconn, $sql3);
        
        $sql4 = "SELECT SUM(\"sum_s_NDS\") AS total_sum FROM \"Akt_ob_okazaniji_uslug\".\"tablep\" AS tablep,
        \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" AS akt WHERE akt.id_akt = '$id' AND tablep.id_akt = akt.id_akt";
        $result4 = pg_query($dbconn, $sql4);

        $sql5 = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"ispolnitel\" AS ispolnitel, \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" AS akt,
        \"Akt_ob_okazaniji_uslug\".\"shapka\" AS shapka WHERE akt.id_akt = '$id' AND akt.id_shapka = shapka.id_shapka AND shapka.cod_org_ispolnitel = ispolnitel.id_ispolnitel";
        $result5 = pg_query($dbconn, $sql5);

        $sql6 = "SELECT * FROM \"Akt_ob_okazaniji_uslug\".\"zakazchik\" AS zakazchik, \"Akt_ob_okazaniji_uslug\".\"Akt_ob_okazaniji_uslug\" AS akt,
        \"Akt_ob_okazaniji_uslug\".\"shapka\" AS shapka WHERE akt.id_akt = '$id' AND akt.id_shapka = shapka.id_shapka AND shapka.cod_org_zakazchik = zakazchik.id_zakazchik";
        $result6 = pg_query($dbconn, $sql6);
        

            echo "<!DOCTYPE html>";
            echo "<html>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<title>Акт об оказании услуг</title>";
            echo "<script>
            function goBack() {
                  window.history.back();
                }
            function printPage() {
                    window.print();
                  }
              </script>";
            echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>";
            echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>";
            echo "<style>";
            echo "body {
                font-family: Arial, sans-serif;
                width: 21cm;
                height: 29.7cm;
                margin: auto;
                padding: 2cm;
              }
              @media print {
                .print-hide {
                  display: none !important;
                }
              }
              h1 {
                text-align: center;
              }
              h2 {
                text-align: center;
              }
              h3 {
                text-align: center;
              }
              
              .but {
                margin-left: 20px;
              }
            
              table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
              }
            
              .twout {
                border: 1px solid black;
              }
              .trout{
                border: 1px solid black;
              }
            
              
              th, td {
                padding: 8px;
                text-align: left;
              }
              
              th {
                background-color: #f2f2f2;
              }
              
              .total {
                text-align: right;
              }";
            echo "</style>";
            echo "<button class='print-hide' onclick='goBack()'>Назад</button>";
            echo "<button class='print-hide but' onclick='printPage()''>Печать</button>";
            echo "</head>";
            echo "<body>";
            while ($row = pg_fetch_assoc($result1)) {
              $months = [
                  1 => 'января',
                  2 => 'февраля',
                  3 => 'марта',
                  4 => 'апреля',
                  5 => 'мая',
                  6 => 'июня',
                  7 => 'июля',
                  8 => 'августа',
                  9 => 'сентября',
                  10 => 'октября',
                  11 => 'ноября',
                  12 => 'декабря',
              ];
              
              $date = $row['akt_date'];
              $parsedDate = date_parse_from_format('Y-m-d', $date);
              
              $day = $parsedDate['day'];
              $month = $months[$parsedDate['month']];
              $year = $parsedDate['year'];
              
              $formattedDate = $day . ' ' . $month . ' ' . $year;
            echo "<h2 class='text-center'>АКТ №" . $row['akt_num'] . " от " . $formattedDate . "г.</h2>";
            echo "<h2 class='text-center'>об оказании услуг</h2>";
            }
            while ($row = pg_fetch_assoc($result2)) {
            echo "<p>Исполнитель <u>" . $row['naim_ispoln'] . "</u> в лице <u>" . $row['FIO_ispolnit'] . "</u> с одной стороны и Заказчик <u>". $row['naim_zakaz'] ."</u> в лице <u>". $row['FIO_zakaz'] ."</u> 
            с другой стороны сосавили настоящий акт о том, что Исполнитель выполнил, а Заказчик принял следующие работы:</p>";
            }
            echo "<table>";
            echo "<tr class='twout'>";
            echo "<th class='trout'>№</th>";
            echo "<th class='trout'>Наименование работы</th>";
            echo "<th class='trout'>Цена, руб</th>";
            echo "<th class='trout'>НДС</th>";
            echo "<th class='trout'>Сумма с НДС, руб</th>";
            echo "</tr>";
            while ($row = pg_fetch_assoc($result3)) {
            echo "<tr class='twout'>";
            echo "<td class='trout'>".$row['num_uslugi']."</td>";
            echo "<td class='trout'>".$row['naim_uslugi']."</td>";
            echo "<td class='trout'>".$row['cost']."</td>";
            echo "<td class='trout'>".$row['NDS']."</td>";
            echo "<td class='trout'>".$row['sum_s_NDS']."</td>";
            echo "</tr>";
            }
            while ($row = pg_fetch_assoc($result4)) {
            echo "<tr>";
            echo "<td colspan='4' class='total'>Итого:</td>";
            echo "<td class='trout'>".$row['total_sum']."</td>";
            echo "</tr>";
            
            echo "</table>";
            echo "<p>Общая стоимость выполненных работ, включая налоги, составила: <u>".$row['total_sum']."руб.</u></p>";
            }
            echo "<p>Работы выполнены в установленные сроки, в полном объеме и с надлежащим качеством. Претензий друг к другу стороны не имеют.</p>";
            
            echo '<table>';
            echo "<tr>";
            echo '<th style="width: 50%;">ИСПОЛНИТЕЛЬ</th>';
            echo '<th style="width: 50%;">ЗАКАЗЧИК</th>';
            echo "</tr>";
            echo "<tr>";
            while (($row = pg_fetch_assoc($result5)) && ($pow = pg_fetch_assoc($result6))){
            echo '<td style="width: 50%;"><u>'.$row['naim_ispoln'].'</u></td>';
            echo '<td style="width: 50%;"><u>'.$pow['naim_zakaz'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
           
                echo '<td style="width: 50%;">ИНН <u>'.$row['INN'].'</u> КПП <u>'.$row['KPP'].'</u></td>';

                echo '<td style="width: 50%;">ИНН <u>'.$pow['INN'].'</u> КПП <u>'.$pow['KPP'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
           echo '<td style="width: 50%;">Адрес <u>'.$row['Adress'].'</u></td>';
           echo '<td style="width: 50%;">Адрес <u>'.$pow['Adress'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
            echo '<td style="width: 50%;">Р/с <u>'.$row['Rschet'].'</u></td>';
            echo '<td style="width: 50%;">Р/с <u>'.$pow['Rschet'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
            echo '<td style="width: 50%;">К/с <u>'.$row['Kschet'].'</u></td>';
            echo '<td style="width: 50%;">К/с <u>'.$pow['Kschet'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
            echo '<td style="width: 50%;">Банк <u>'.$row['Bank'].'</u></td>';
            echo '<td style="width: 50%;">Банк <u>'.$pow['Bank'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
            echo '<td style="width: 50%;">БИК <u>'.$row['BIK'].'</u></td>';
            echo '<td style="width: 50%;">БИК <u>'.$pow['BIK'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
            echo '<td style="width: 50%;">Телефон <u>'.$row['Phone'].'</u></td>';
            echo '<td style="width: 50%;">Телефон <u>'.$pow['Phone'].'</u></td>';
            echo "</tr>";
            echo "<tr>";
            echo '<td></td>';
            echo '<td></td>';
            echo "</tr>";
            echo "<tr>";
            echo '<td style="width: 50%; text-align: center; vertical-align: middle;"><b>М.П.</b></td>';
            echo '<td style="width: 50%; text-align: center; vertical-align: middle;"><b>М.П.</b></td>';
            echo "</tr>";
        }
            echo "</table>";
            echo "</body>";
            
            echo "</html>";
    
   
    }

?>