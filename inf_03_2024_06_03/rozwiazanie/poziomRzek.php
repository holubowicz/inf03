<?php
$db = new mysqli("localhost", "root", "", "rzeki");
$water_meters_option = $_GET["option"];

$water_meters_query = "SELECT w.nazwa, w.rzeka, w.stanOstrzegawczy, w.stanAlarmowy, p.stanWody
    FROM wodowskazy w
    JOIN pomiary p ON w.id = p.wodowskazy_id
    WHERE p.dataPomiaru = '2022-05-05' ";

switch ($water_meters_option) {
    case "warning":
        $water_meters_query .= "AND p.stanWody > w.stanOstrzegawczy";
        break;
    case "alarming":
        $water_meters_query .= "AND p.stanWody > w.stanAlarmowy";
        break;
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poziomy rzek</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <div>
            <img src="obraz1.png" alt="Mapa Polski">
        </div>

        <div>
            <h3>Rzeki w województwie dolnośląskim</h3>
        </div>
    </header>

    <nav>
        <form>
            <input type="radio" name="option" value="all" id="option--all" <?= $water_meters_option == "all" ? "checked" : "" ?>>
            <label class="option__label" for="option--all">
                Wszystkie
            </label>

            <input type="radio" name="option" value="warning" id="option--warning" <?= $water_meters_option == "warning" ? "checked" : "" ?>>
            <label class="option__label" for="option--warning">
                Ponad stan ostrzegawczy
            </label>

            <input type="radio" name="option" value="alarming" id="option--alarming" <?= $water_meters_option == "alarming" ? "checked" : "" ?>>
            <label class="option__label" for="option--alarming">
                Ponad stan alarmowy
            </label>

            <button type="submit">Pokaż</button>
        </form>
    </nav>

    <main>
        <h3>Stan na dzień 2022-05-05</h3>

        <table>
            <tr>
                <th>Wodomierz</th>
                <th>Rzeka</th>
                <th>Ostrzegawczy</th>
                <th>Alarmowy</th>
                <th>Aktualny</th>
            </tr>

            <?php
            $water_meters_result = $db->query($water_meters_query);
            while ($water_meter = $water_meters_result->fetch_row()):
                ?>
                <tr>
                    <td><?= $water_meter[0] ?></td>
                    <td><?= $water_meter[1] ?></td>
                    <td><?= $water_meter[2] ?></td>
                    <td><?= $water_meter[3] ?></td>
                    <td><?= $water_meter[4] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>

    <aside>
        <h3>Informacje</h3>

        <ul>
            <li>Brak ostrzeżeń o burzach z gradem</li>
            <li>Smog w mieście Wrocław</li>
            <li>Silny wiatr w Karkonoszach</li>
        </ul>

        <h3>Średni stan wód</h3>

        <?php
        $average_water_levels_query = "SELECT dataPomiaru, AVG(stanWody) FROM pomiary GROUP BY dataPomiaru";
        $average_water_levels_result = $db->query($average_water_levels_query);

        while ($water_level = $average_water_levels_result->fetch_row()):
            ?>
            <p><?= "{$water_level[0]}: {$water_level[1]}" ?></p>
        <?php endwhile; ?>

        <a href="https://komunikaty.pl">Dowiedz się więcej</a>

        <img src="obraz2.jpg" alt="rzeka">
    </aside>

    <footer>
        <p>Stonę wykonał: 00000000000</p>
    </footer>
</body>

</html>

<?php
$db->close();
?>