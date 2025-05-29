<?php
$db = new mysqli("localhost", "root", "", "kupauto");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komis aut</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <h1>
            <em>KupAuto!</em>
            Internetowy Komis Samochodowy
        </h1>
    </header>

    <section class="main-content__1">
        <?php
        $query_1 = "SELECT model, rocznik, przebieg, paliwo, cena, zdjecie
            FROM samochody
            WHERE id = 10";
        $day_deal = $db->query($query_1)->fetch_assoc();
        ?>

        <img src="<?= $day_deal['zdjecie'] ?>" alt="oferta dnia">
        <h4>Oferta Dnia: Toyota <?= $day_deal['model'] ?></h4>
        <p>
            Rocznik: <?= $day_deal['rocznik'] ?>,
            przebieg: <?= $day_deal['przebieg'] ?>,
            rodzaj paliwa: <?= $day_deal['paliwo'] ?>
        </p>
        <h4>Cena: <?= $day_deal['cena'] ?></h4>
    </section>

    <section class="main-content__2-3">
        <h2>Oferty Wyrónione</h2>

        <?php
        $query_2 = "SELECT m.nazwa, s.model, s.rocznik, s.cena, s.zdjecie
            FROM marki m
            JOIN samochody s ON m.id = s.marki_id
            WHERE s.wyrozniony = 1
            LIMIT 4";
        $featured_offers = $db->query($query_2)->fetch_all(MYSQLI_ASSOC);

        foreach ($featured_offers as $offer):
            ?>
            <article>
                <img src="<?= $offer['zdjecie'] ?>" alt="<?= $offer['model'] ?>">
                <h4><?= $offer['nazwa'] ?>&nbsp;<?= $offer['model'] ?></h4>
                <p>Rocznik: <?= $offer['rocznik'] ?></p>
                <h4>Cena: <?= $offer['cena'] ?></h4>
            </article>
        <?php endforeach; ?>
    </section>

    <section class="main-content__2-3">
        <h2>Wybierz markę</h2>

        <form method="post">
            <select name="make">
                <?php
                $query_3 = "SELECT nazwa FROM marki";
                $makes = $db->query($query_3)->fetch_all(MYSQLI_NUM);
                foreach ($makes as $make):
                    ?>
                    <option value="<?= $make[0] ?>"><?= $make[0] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Wyszukaj</button>
        </form>

        <?php
        $option_make = $_POST['make'];

        if (!empty($option_make)):
            $query_4 = "SELECT s.model, s.cena, s.zdjecie
                FROM samochody s
                JOIN marki m ON s.marki_id = m.id
                WHERE m.nazwa = '$option_make'";
            $selected_cars = $db->query($query_4)->fetch_all(MYSQLI_ASSOC);

            foreach ($selected_cars as $car):
                ?>
                <article>
                    <img src="<?= $car['zdjecie'] ?>" alt="<?= $car['model'] ?>">
                    <h4><?= $option_make ?>&nbsp;<?= $car['model'] ?></h4>
                    <h4>Cena: <?= $car['cena'] ?></h4>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <footer>
        <p>Stronę wykonał: 00000000000</p>
        <p><a href="http://firmy.pl/komis">Znajdź nas także</a></p>
    </footer>
</body>

</html>

<?php
$db->close();
?>