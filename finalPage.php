<?php
session_start();

// Ici vous pouvez vider le panier ou effectuer d'autres opérations nécessaires
unset($_SESSION["nom"]);
unset($_SESSION["quantite"]);
unset($_SESSION["Transporteurs"]);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Commande finalisée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Commande finalisée</h2>
        <p>Votre commande a été finalisée avec succès. Merci pour votre achat !</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0sG1M5b4hcpxyD9F7jL+QU/XoP5Yl55q1PIFlrTBrqVVSUsL" crossorigin="anonymous"></script>
</body>

</html>
