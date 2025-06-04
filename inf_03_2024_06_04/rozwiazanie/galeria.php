<?php
$db = new mysqli("localhost", "root", "", "galeria");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <h1>Zdjęcia</h1>
    </header>

    <aside>
        <h2>Tematy zdjęć</h2>

        <ol>
            <li>Zwierzęta</li>
            <li>Krajobrazy</li>
            <li>Miasta</li>
            <li>Przyroda</li>
            <li>Samochody</li>
        </ol>
    </aside>

    <main>
        <?php
        $images_query = "SELECT z.plik, z.tytul, z.polubienia, a.imie, a.nazwisko
            FROM zdjecia z
            JOIN autorzy a ON z.autorzy_id = a.id
            ORDER BY a.nazwisko";
        $images_result = $db->query($images_query);

        while ($image = $images_result->fetch_assoc()):
            ?>
            <article class="gallery-img">
                <img src="<?= $image['plik'] ?>" alt="zdjęcie">
                <h3><?= $image['tytul'] ?></h3>
                <p>
                    Autor: <?= "{$image['imie']} {$image['nazwisko']}" ?>.
                    <?php if ($image['polubienia'] > 40): ?>
                        <br>Wiele osób polubiło ten obraz.
                    <?php endif; ?>
                </p>
                <a href="<?= $image['plik'] ?>" download>Pobierz</a>
            </article>
        <?php endwhile; ?>
    </main>

    <aside>
        <h2>Najbardziej lubiane</h2>

        <?php
        $most_liked_image_query = "SELECT tytul, plik FROM zdjecia WHERE polubienia >= 100";
        $most_liked_image = $db->query($most_liked_image_query)->fetch_row();
        ?>

        <img src="<?= $most_liked_image[1] ?>" alt="<?= $most_liked_image[0] ?>">

        <strong>Zobacz wszystkie nasze zdjęcia</strong>
    </aside>

    <footer>
        <h5>Stronę wykonał: 00000000000</h5>
    </footer>
</body>

</html>

<?php
$db->close();
?>