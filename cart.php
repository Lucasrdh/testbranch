<?php
session_start();
include "database.php";
include "my-functions.php";

// IMPORTANT 

if (!empty($_POST)) {
    $_SESSION = $_POST;
}

if (isset($_SESSION["nom"])) {

    $name = $_SESSION["nom"];
    $quantite = $_SESSION['quantite'];

    foreach ($mangas as $manga) {
        if ($manga['nom'] == $name) {
            $prix = $manga['prix'];
            $discount = $manga['discount'];
            $poids = $manga['poids'];
            break;
        }
    }


    
    // Convertir le prix en euros
    $prixEnEuros = formatPrice($prix);

    // Calculer le prix avec la réduction
    $prixDiscount = discountedPrice($prixEnEuros, $discount);

    $prixTotal = total($prixDiscount, $_SESSION["quantite"]);

    //Calculer la tva
    $prixSansTva = priceHorsTax($prixEnEuros);

    // Calculer la différence TVA

    $diffTVA = tva($prixEnEuros, $prixSansTva);

    if (!empty($_SESSION['Transporteurs'])) {
        $totalTTC = checkFDP($poids, $quantite, $prixTotal);
    }
}


//var_dump($name);
//var_dump($mangas);
// var_dump($_POST);

// echo "<br>" . "<br>" . "<br>" . "<br>";
// var_dump($_SESSION);
//session_destroy();


?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Mon Panier</h2>
        <h3>Transporteur</h3>
        <form action="" method="POST">
            <label for="Transporteurs">Méthode de livraison :</label>
            <select name="Transporteurs" id="Transporteurs">
                <option value="Transp1">Amazon</option>
                <option value="Transp2">Chronopost</option>
            </select>
            <input type="hidden" name="quantite" value="<?= $quantite ?>">
            <input type="hidden" name="nom" value="<?= $name ?>">
            <button type="submit" name="submit">Envoyer</button>
        </form>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Produit</th>
                    <th>Prix sans TVA</th>
                    <th>Prix (discount)</th>
                    <th>TVA</th>
                    <th>Quantité </th>
                    <th>Total</th>
                    <th>Total TTC + FDP</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $name ?></td>
                    <td><?= $prixSansTva; ?> €</td>
                    <td><?= $prixDiscount ?></td>
                    <td><?php echo $diffTVA; ?> €</td>
                    <td><?php echo $quantite; ?></td>

                    <td><?php echo (total($prixDiscount, $quantite)) ?> </td>

                    <td><?php if (!empty($_SESSION['Transporteurs'])) {
                            echo $totalTTC . '€';
                        } else {
                            echo 'Attente de transporteurs';
                        } ?> </td>
                </tr>

            </tbody>
            <!-- <?php if (!empty($_SESSION['Transporteurs'])) { ?>
                <form action="" method="POST">
                    <button type="submit" name="emptyCart">Finaliser la commande</button>
                </form>
            <?php } ?> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0sG1M5b4hcpxyD9F7jL+QU/XoP5Yl55q1PIFlrTBrqVVSUsL" crossorigin="anonymous"></script>
</body>

</html>