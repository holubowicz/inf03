<?php
$db = new mysqli("localhost", "root", "", "motory");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motocykle</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <img src="motor.png" alt="motocykl">

    <header>
        <h1>Motocykle - moja pasja</h1>
    </header>

    <main>
        <h2>Gdzie pojechać?</h2>

        <dl>
            <?php
            $trips_info_query = "SELECT w.nazwa, w.opis, w.poczatek, z.zrodlo
                FROM wycieczki w
                JOIN zdjecia z ON w.zdjecia_id = z.id";
            $trips_info_result = $db->query($trips_info_query);

            while ($trip = $trips_info_result->fetch_assoc()):
                ?>
                <dt>
                    <?= $trip['nazwa'] ?>,
                    rozpoczyna się w
                    <?= $trip['poczatek'] ?>,
                    <a href="<?= $trip['zrodlo'] ?>.jpg">
                        zobacz zdjęcie
                    </a>
                </dt>

                <dd>
                    <?= $trip['opis'] ?>
                </dd>
            <?php endwhile; ?>
        </dl>
    </main>

    <aside>
        <h2>Co kupić?</h2>

        <ol>
            <li>Honda CBR125R</li>
            <li>Yamaha YBR125</li>
            <li>Honda VFR800i</li>
            <li>Honda CBR1100XX</li>
            <li>BMW R1200GS LC</li>
        </ol>
    </aside>

    <aside>
        <h2>Statystyki</h2>

        <p>
            Wpisanych wycieczek:
            <?php
            $trips_count_query = "SELECT COUNT(id) FROM wycieczki";
            $trips_count = $db->query($trips_count_query)->fetch_row();
            echo $trips_count[0];
            ?>
        </p>

        <p>Użytkowników forum: 200</p>

        <p>Przesłanych zdjęć: 1300</p>
    </aside>

    <footer>
        <p>Stronę wykonał: 00000000000</p>
    </footer>
</body>

</html>

<?php
$db->close();
?>