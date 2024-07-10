<?php
session_start();

include "database.php";
include "my-functions.php";


?>
<!DOCTYPE html>
<html>

<head>
    <title>Manga Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($mangas as $manga => $value) { ?>
                <div class='col'>
                    <div class='card h-100'>
                        <img src="<?= $value['image'] ?>" class="card-img-top" alt="Image de <?= $value['nom'] ?>">
                        <div class='card-body'>
                            <h3 class='card-title'> <?= $value['nom'] ?></h3>
                            <p class='card-text'> Prix: <?= formatPrice($value['prix']) ?> € </p>
                            <p class='card-text'>Poids: <?= $value['poids'] ?> </p>
                            <p class='card-text'>Discount: <?= $value['discount'] ?> %</p>
                            <p class='card-text'> <?= discountedPrice(formatPrice($value['prix']), $value['discount']) ?> € With discount</p>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="nom" value="<?= $value['nom'] ?>">

                                Quantité: <input type="number" name="quantite" min="1" max="10" required><br><br>
                                <input type="submit" value="Ajouter au panier">

                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0sG1M5b4hcpxyD9F7jL+QU/XoP5Yl55q1PIFlrTBrqVVSUsL" crossorigin="anonymous"></script>
</body>

</html>