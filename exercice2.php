<?php
session_start();



function initialiserPanier() {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
}

function ajouterProduit($nom, $prix, $quantite) {
    if (isset($_SESSION['panier'][$nom])) {
        $_SESSION['panier'][$nom]['quantite'] += $quantite;
    } else {
        $_SESSION['panier'][$nom] = [
            'prix' => $prix,
            'quantite' => $quantite
        ];
    }
}

function supprimerProduit($nom) {
    if (isset($_SESSION['panier'][$nom])) {
        unset($_SESSION['panier'][$nom]);
    }
}

function afficherPanier() {
    if (empty($_SESSION['panier'])) {
        echo "<p style='text-align:center;'>🛒 Votre panier est vide.</p>";
    } else {
        echo "<h2 style='text-align:center;'>Votre Panier 🛍️</h2>";
        echo "<table border='1' cellpadding='10' style='margin:auto; background-color:#fff;'>";
        echo "<tr><th>Produit</th><th>Prix Unitaire (€)</th><th>Quantité</th><th>Total (€)</th><th>Action</th></tr>";

        $totalGeneral = 0;
        foreach ($_SESSION['panier'] as $nom => $details) {
            $total = $details['prix'] * $details['quantite'];
            $totalGeneral += $total;
            echo "<tr>";
            echo "<td>$nom</td>";
            echo "<td>" . number_format($details['prix'], 2) . "</td>";
            echo "<td>" . $details['quantite'] . "</td>";
            echo "<td>" . number_format($total, 2) . "</td>";
            echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='supprimer' value='$nom'>
                    <input type='submit' value='Supprimer ❌' style='background-color:red; color:white; border:none; padding:5px 10px; border-radius:5px;'>
                </form>
            </td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='3'><strong>Total Général</strong></td><td colspan='2'><strong>" . number_format($totalGeneral, 2) . " €</strong></td></tr>";
        echo "</table>";
    }
}


initialiserPanier();

$produitsDisponibles = [
    "Souris" => 10,
    "Clavier" => 35,
    "Ecran" => 250
];


if (isset($_POST['commander'])) {
    $prix = intval($_POST['nom']);
    $quantite = intval($_POST['quantite']);

    $nomProduit = array_search($prix, $produitsDisponibles);

    if ($nomProduit && $quantite > 0) {
        ajouterProduit($nomProduit, $prix, $quantite);
        echo "<p style='color:green; text-align:center;'>Produit '$nomProduit' ajouté au panier ✅</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Veuillez choisir un produit valide et une quantité correcte ❗</p>";
    }
}


if (isset($_POST['supprimer'])) {
    $produitASupprimer = $_POST['supprimer'];
    supprimerProduit($produitASupprimer);
    echo "<p style='color:orange; text-align:center;'>Produit '$produitASupprimer' supprimé du panier ❌</p>";
}


if (isset($_POST['afficher'])) {
    afficherPanier();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Produits - Panier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
        }

        h1 {
            color: #00698f;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, input[type="number"] {
            width: 100%;
            height: 40px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 45%;
            height: 40px;
            padding: 10px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:first-child {
            background-color: #03A9F4;
            color: #fff;
        }

        input[type="submit"]:last-child {
            background-color: #03A9F4;
            color: #fff;
        }

        input[type="submit"]:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<h1>Gestion des Produits</h1>

<form method="post">
    <div>
        <label for="nom">Nom du produit :</label>
        <select id="produits" name="nom" required>
            <option value="0">Choisir un produit</option>
            <option value="10">Souris</option>
            <option value="35">Clavier</option>
            <option value="250">Ecran</option>
        </select>
    </div>

    <div>
        <label for="quantite">Quantité commandée :</label>
        <input type="number" id="quantite" name="quantite" min="1" required>
    </div>

    <div>
        <input type="submit" value="Commander 🛍️" name="commander">
        <input type="submit" value="Afficher 🛒" name="afficher">
    </div>
</form>

<hr>

<?php

afficherPanier();
?>

</body>
</html>
