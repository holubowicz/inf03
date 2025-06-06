<?php
$db = new mysqli("localhost", "root", "", "hodowla");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hodowla świnek morskich</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <h1>Hodowla świnek morskich - zamów świnkowe maluszki</h1>
    </header>

    <nav>
        <a href="peruwianka.php">
            Rasa Peruwianka
        </a>

        <a href="american.php">
            Rasa American
        </a>

        <a href="crested.php">
            Rasa Crested
        </a>
    </nav>

    <aside>
        <h3>Poznaj wszystkie rasy świnek morskich</h3>

        <ol>
            <?php
            $breeds_query = "SELECT rasa FROM rasy";
            $breeds_result = $db->query($breeds_query);

            while ($breed = $breeds_result->fetch_row()):
                ?>
                <li><?= $breed[0] ?></li>
            <?php endwhile; ?>
        </ol>
    </aside>

    <main>
        <img src="crested.jpg" alt="Świnka morska rasy crested">

        <?php
        $litter_query = "SELECT DISTINCT s.data_ur, s.miot, r.rasa
            FROM swinki s
            JOIN rasy r ON s.rasy_id = r.id
            WHERE r.id = 7";
        $litter_result = $db->query($litter_query);

        while ($litter = $litter_result->fetch_assoc()):
            ?>
        <h2>
            Rasa:
            <?= $litter['rasa'] ?>
        </h2>

        <p>
            Data urodzenia:
            <?= $litter['data_ur'] ?>
        </p>

        <p>
            Oznaczenie miotu:
            <?= $litter['miot'] ?>
        </p>
        <?php endwhile; ?>

        <hr>

        <h2>Świnki w tym miocie</h2>

        <?php
        $guinea_pigs_query = "SELECT imie, cena, opis
            FROM swinki
            WHERE rasy_id = 7";
        $guinea_pigs_result = $db->query($guinea_pigs_query);

        while ($guinea_pig = $guinea_pigs_result->fetch_assoc()):
            ?>
            <h3>
                <?= $guinea_pig['imie'] ?>
                -
                <?= $guinea_pig['cena'] ?>
                zł
            </h3>

            <p><?= $guinea_pig['opis'] ?></p>
        <?php endwhile; ?>
    </main>

    <footer>
        <p>Stronę wykonał: 00000000000</p>
    </footer>
</body>

</html>

<?php
$db->close();
?>
