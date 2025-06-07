<?php
$db = new mysqli("localhost", "root", "", "kalendarz");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalendarz</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <h1>Dni, miesiące, lata...</h1>
    </header>

    <div id="caption">
        <p>
            <?php
            $current_month_day = date("m-d");
            $todays_names_query = "SELECT imiona FROM imieniny WHERE data = '$current_month_day'";
            $todays_names_row = $db->query($todays_names_query)->fetch_row();
            
            $day_month_year = date("d-m-Y");
            $weekday_index = date("w");
            $weekday = "";

            if ($weekday_index == 0) {
                $weekday = "niedziela";
            } elseif ($weekday_index == 1) {
                $weekday = "poniedziałek";
            } elseif ($weekday_index == 2) {
                $weekday = "wtorek";
            } elseif ($weekday_index == 3) {
                $weekday = "środa";
            } elseif ($weekday_index == 4) {
                $weekday = "czwartek";
            } elseif ($weekday_index == 5) {
                $weekday = "piątek";
            } elseif ($weekday_index == 6) {
                $weekday = "sobota";
            }

            echo "Dzisiaj jest $weekday, $day_month_year, imieniny: {$todays_names_row[0]}";
            ?>
        </p>
    </div>

    <aside>
        <table>
            <tr>
                <th>liczba dni</th>
                <th>miesiąc</th>
            </tr>

            <tr>
                <td rowspan="7">31</td>
                <td>styczeń</td>
            </tr>
            <tr>
                <td>marzec</td>
            </tr>
            <tr>
                <td>maj</td>
            </tr>
            <tr>
                <td>lipiec</td>
            </tr>
            <tr>
                <td>sierpień</td>
            </tr>
            <tr>
                <td>październik</td>
            </tr>
            <tr>
                <td>grudzień</td>
            </tr>

            <tr>
                <td rowspan="4">30</td>
                <td>kwiecień</td>
            </tr>
            <tr>
                <td>czerwiec</td>
            </tr>
            <tr>
                <td>wrzesień</td>
            </tr>
            <tr>
                <td>listopad</td>
            </tr>

            <tr>
                <td>28 lub 29</td>
                <td>luty</td>
            </tr>
        </table>
    </aside>

    <main>
        <h2>Sprawdź kto ma urodziny</h2>

        <form method="post">
            <input type="date" name="date" min="2024-01-01" max="2024-12-31" required>
            <button type="submit">
                Wyślij
            </button>
        </form>

        <?php
        if (isset($_POST['date'])) {
            $selected_month_day = date("m-d", strtotime($_POST['date']));

            $names_query = "SELECT imiona FROM imieniny WHERE data = '$selected_month_day'";
            $names_row = $db->query($names_query)->fetch_row();

            echo "Dnia {$_POST['date']} są imieniny: {$names_row[0]}";
        }
        ?>
    </main>

    <aside>
        <a href="https://pl.wikipedia.org/wiki/Kalendarz_Majo%CC%81w" target="_blank">
            <img src="kalendarz.gif" alt="Kalendarz Majów">
        </a>

        <h2>Rodzaje kalendarzy</h2>

        <ol>
            <li>
                słoneczny
                <ul>
                    <li>kalendarz Majów</li>
                    <li>juliański</li>
                    <li>gregoriański</li>
                </ul>
            </li>
            <li>
                księżycowy
                <ul>
                    <li>starogrecki</li>
                    <li>babiloński</li>
                </ul>
            </li>
        </ol>
    </aside>

    <footer>
        <p>Stronę opracował(a): 00000000000</p>
    </footer>
</body>

</html>

<?php
$db->close();
?>