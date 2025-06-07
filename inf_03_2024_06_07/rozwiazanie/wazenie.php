<?php
$db = new mysqli("localhost", "root", "", "wazenietirow");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ważenie samochodów ciężarowych</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <div>
            <h1>Ważenie pojazdów we Wrocławiu</h1>
        </div>

        <div>
            <img src="obraz1.png" alt="waga">
        </div>
    </header>

    <aside>
        <h2>Lokalizacje wag</h2>

        <ol>
            <?php
            $streets_query = "SELECT ulica FROM lokalizacje";
            $streets_result = $db->query($streets_query);
            while ($street = $streets_result->fetch_row()):
                ?>
                <li>ulica <?= $street[0] ?></li>
            <?php endwhile; ?>
        </ol>

        <h2>Kontakt</h2>

        <a href="mailto:wazenie@wroclaw.pl">napisz</a>
    </aside>

    <main>
        <h2>Alerty</h2>

        <table>
            <tr>
                <th>rejestracja</th>
                <th>ulica</th>
                <th>waga</th>
                <th>dzień</th>
                <th>czas</th>
            </tr>

            <?php
            $alerts_query = "SELECT w.rejestracja, l.ulica, w.waga, w.dzien, w.czas
                FROM wagi w
                JOIN lokalizacje l ON w.lokalizacje_id = l.id
                WHERE w.waga > 5";
            $alerts_result = $db->query($alerts_query);
            while ($alert = $alerts_result->fetch_row()):
                ?>
                <tr>
                    <td><?= $alert[0] ?></td>
                    <td><?= $alert[1] ?></td>
                    <td><?= $alert[2] ?></td>
                    <td><?= $alert[3] ?></td>
                    <td><?= $alert[4] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <?php
        $insert_new_weight_query = "INSERT INTO wagi (lokalizacje_id, waga, rejestracja, dzien, czas)
            VALUES (5, FLOOR(RAND() * 10 + 1), 'DW12345', CURRENT_DATE(), CURRENT_TIME())";
        $db->query($insert_new_weight_query);
        ?>

        <script>
            setTimeout(() => location.reload(), 10_000);
        </script>
    </main>

    <aside>
        <img src="obraz2.jpg" alt="tir">
    </aside>

    <footer>
        <p>Stronę wykonał: 00000000000</p>
    </footer>
</body>

</html>

<?php
$db->close();
?>