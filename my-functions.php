<?php
include "database.php";

function rechercheBDD($laRequete, $mysqlClient)
{
	$lesRequete = $mysqlClient->prepare($laRequete);
	$lesRequete->execute();
	$requete = $lesRequete->fetchAll();
	return $requete;
}
function priceHorsTax($TTC)
{
    $TVA = 20;
    $HT = (100 * $TTC) / (100 + $TVA);
    return number_format($HT, 2);
}

function formatPrice($prixcentime)
{
    $prixTTC = $prixcentime / 100;


    return $prixTTC;
}

function discountedPrice($prixTTC, $discount)
{

    $reduc = $prixTTC * ($discount / 100);
    $prixTTC = $prixTTC - $reduc;
    $prixréduit = $prixTTC;

    // echo number_format($prixTTC,2). "€ With discount";
    return $prixréduit;
}
function total($prixDiscount, $nbrArticle)
{
    $prixTotal = $nbrArticle * $prixDiscount;
    return $prixTotal;
}
function tva($TTC, $HT)
{
    $diffTVA = $TTC - $HT;
    return number_format($diffTVA, 2);
}

function checkFDP($poids, $quantite, $prixTotal)
{
    if ($_SESSION['Transporteurs'] == 'Transp1') {
        if ($poids * $quantite < 500) {
            $prixTotal =  $prixTotal + 2;
            return $prixTotal;
        } elseif ($poids * $quantite > 500 && $poids * $quantite < 2000) {
            $prixTotal = $prixTotal * 1.10;
            return $prixTotal;
        } elseif ($poids * $quantite > 2000) {
            return $prixTotal;
        }
    } elseif ($_SESSION['Transporteurs'] == 'Transp2') {
        if ($poids * $quantite < 500) {
            $prixTotal =  $prixTotal + 1;
            return $prixTotal;
        } elseif ($poids * $quantite > 500 && $poids * $quantite < 2000) {
            $prixTotal = $prixTotal * 1.05;
            return $prixTotal;
        } elseif ($poids * $quantite > 2000) {
            return $prixTotal;
        }
    }
}

// function emptyCart() {
//     if (isset($_SESSION)) {
//         session_unset(); // Efface toutes les variables de session
//         session_destroy(); // Détruit la session
//         session_start(); // Redémarre la session
//     }
// }