<?php
$db = new mysqli("localhost", "root", "", "rzeki");
$option = $_GET["option"];

$query_1 = "SELECT w.nazwa, w.rzeka, w.stanOstrzegawczy, w.stanAlarmowy, p.stanWody
    FROM wodowskazy w
    JOIN pomiary p ON w.id = p.wodowskazy_id
    WHERE p.dataPomiaru = '2022-05-05' ";

switch ($option) {
    case "warning":
        $query_1 .= "AND p.stanWody > w.stanOstrzegawczy";
        break;
    case "alarming":
        $query_1 .= "AND p.stanWody > w.stanAlarmowy";
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
            <input type="radio" name="option" value="all" id="option--all" <?= $option == "all" ? "checked" : "" ?>>
            <label class="option__label" for="option--all">
                Wszystkie
            </label>

            <input type="radio" name="option" value="warning" id="option--warning" <?= $option == "warning" ? "checked" : "" ?>>
            <label class="option__label" for="option--warning">
                Ponad stan ostrzegawczy
            </label>

            <input type="radio" name="option" value="alarming" id="option--alarming" <?= $option == "alarming" ? "checked" : "" ?>>
            <label class="option__label" for="option--alarming">
                Ponad stan alarmowy
            </label>

            <button type="submit">Pokaż</button>
        </form>
    </nav>

    <section class="main-content main-content--left">
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
            $result = $db->query($query_1)->fetch_all(MYSQLI_NUM);
            foreach ($result as $row):
                ?>
                <tr>
                    <td><?= $row[0] ?></td>
                    <td><?= $row[1] ?></td>
                    <td><?= $row[2] ?></td>
                    <td><?= $row[3] ?></td>
                    <td><?= $row[4] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section class="main-content main-content--right">
        <h3>Informacje</h3>

        <ul>
            <li>Brak ostrzeżeń o burzach z gradem</li>
            <li>Smog w mieście Wrocław</li>
            <li>Silny wiatr w Karkonoszach</li>
        </ul>

        <h3>Średni stan wód</h3>

        <?php
        $query_2 = "SELECT dataPomiaru, AVG(stanWody) FROM pomiary GROUP BY dataPomiaru";
        $average_water_level = $db->query($query_2)->fetch_all(MYSQLI_NUM);

        foreach ($average_water_levels as $water_level):
            ?>
            <p><?= $water_level[0] . ": " . $water_level[1] ?></p>
        <?php endforeach; ?>

        <a href="https://komunikaty.pl">Dowiedz się więcej</a>

        <img src="obraz2.jpg" alt="rzeka">
    </section>

    <footer>
        <p>Stonę wykonał: 00000000000</p>
    </footer>
</body>

</html>

<?php
$db->close();
?>