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

    <section id="main-content-1">
        <?php
        $day_deal_query = "SELECT model, rocznik, przebieg, paliwo, cena, zdjecie
            FROM samochody
            WHERE id = 10";
        $day_deal = $db->query($day_deal_query)->fetch_assoc();
        ?>

        <img src="<?= $day_deal['zdjecie'] ?>" alt="oferta dnia">
        <h4>
            Oferta Dnia: Toyota
            <?= $day_deal['model'] ?>
        </h4>
        <p>
            Rocznik:
            <?= $day_deal['rocznik'] ?>,
            przebieg:
            <?= $day_deal['przebieg'] ?>,
            rodzaj paliwa:
            <?= $day_deal['paliwo'] ?>
        </p>
        <h4>
            Cena:
            <?= $day_deal['cena'] ?>
        </h4>
    </section>

    <section id="main-content-2">
        <h2>Oferty Wyrónione</h2>

        <?php
        $featured_offers_query = "SELECT m.nazwa, s.model, s.rocznik, s.cena, s.zdjecie
            FROM marki m
            JOIN samochody s ON m.id = s.marki_id
            WHERE s.wyrozniony = 1
            LIMIT 4";
        $featured_offers_result = $db->query($featured_offers_query);

        while ($offer = $featured_offers_result->fetch_assoc()):
            ?>
            <article>
                <img src="<?= $offer['zdjecie'] ?>" alt="<?= $offer['model'] ?>">
                <h4><?= "{$offer['nazwa']} {$offer['model']}" ?></h4>
                <p>Rocznik: <?= $offer['rocznik'] ?></p>
                <h4>Cena: <?= $offer['cena'] ?></h4>
            </article>
        <?php endwhile; ?>
    </section>

    <section id="main-content-3">
        <h2>Wybierz markę</h2>

        <form method="post">
            <select name="make">
                <?php
                $makes_query = "SELECT nazwa FROM marki";
                $makes_result = $db->query($makes_query);
                while ($make = $makes_result->fetch_row()):
                    ?>
                    <option value="<?= $make[0] ?>"><?= $make[0] ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Wyszukaj</button>
        </form>

        <?php
        $option_make = $_POST['make'];

        if (!empty($option_make)):
            $selected_cars_query = "SELECT s.model, s.cena, s.zdjecie
                FROM samochody s
                JOIN marki m ON s.marki_id = m.id
                WHERE m.nazwa = '$option_make'";
            $selected_cars_result = $db->query($selected_cars_query);

            while ($car = $selected_cars_result->fetch_assoc()):
                ?>
                <article>
                    <img src="<?= $car['zdjecie'] ?>" alt="<?= $car['model'] ?>">
                    <h4><?= "$option_make {$car['model']}" ?></h4>
                    <h4>Cena: <?= $car['cena'] ?></h4>
                </article>
            <?php endwhile; ?>
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