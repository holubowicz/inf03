<?php
$db = new mysqli("localhost", "root", "", "piekarnia");
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIEKARNIA</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <img src="wypieki.png" alt="Produkty naszej piekarni">

    <nav>
        <a href="kw1.png">
            KWERENDA1
        </a>
        <a href="kw2.png">
            KWERENDA2
        </a>
        <a href="kw3.png">
            KWERENDA3
        </a>
        <a href="kw4.png">
            KWERENDA4
        </a>
    </nav>

    <header>
        <h1>WITAMY</h1>

        <h4>NA STRONIE PIEKARNI</h4>

        <p>
            Od 31 lat oferujemy najwyższej jakości pieczywo. Naturalnie świeże, naturalnie smaczne. Pieczemy wyłącznie
            wypieki na naturalnym zakwasie bez polepszaczy i zagęstników. Korzystamy wyłącznie z najlepszych ziaren
            pochodzących z ekologicznych upraw położonych w rejonach zgierskim i ozorkowskim.
        </p>
    </header>

    <main>
        <h4>Wybierz rodzaj wypieków:</h4>

        <form method="post">
            <select name="type">
                <?php
                $types_query = "SELECT DISTINCT Rodzaj
                    FROM wyroby
                    ORDER BY Rodzaj DESC";
                $types_result = $db->query($types_query);

                while ($type = $types_result->fetch_row()):
                    ?>
                    <option value="<?= $type[0] ?>">
                        <?= $type[0] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">
                Wybierz
            </button>
        </form>

        <table>
            <tr>
                <th>Rodzaj</th>
                <th>Nazwa</th>
                <th>Gramatura</th>
                <th>Cena</th>
            </tr>

            <?php
            if (!empty($_POST['type'])):
                $bakery_goods_query = "SELECT Rodzaj, Nazwa, Gramatura, Cena
                    FROM wyroby
                    WHERE Rodzaj = '{$_POST['type']}'";
                $bakery_goods_result = $db->query($bakery_goods_query);

                while ($bakery_good = $bakery_goods_result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $bakery_good['Rodzaj'] ?></td>
                        <td><?= $bakery_good['Nazwa'] ?></td>
                        <td><?= $bakery_good['Gramatura'] ?></td>
                        <td><?= $bakery_good['Cena'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
    </main>

    <footer>
        <p>AUTOR: 00000000000</p>
        <p>Data: 08.06.2025</p>
    </footer>
</body>

</html>

<?php
$db->close();
?>