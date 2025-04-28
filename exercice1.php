<?php
$produits = [
    "Pomme" => ["prix" => 1.50, "quantite" => 30],
    "Banane" => ["prix" => 1.20, "quantite" => 25],
    "Orange" => ["prix" => 2.00, "quantite" => 15]
];

session_start();
if (!isset($_SESSION['produits'])) {
    $_SESSION['produits'] = $produits;
}

$produits = $_SESSION['produits'];

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prix = floatval($_POST['prix']);
    $quantite = intval($_POST['quantite']);

    if (!empty($nom) && $prix > 0 && $quantite >= 0) {
        $produits[$nom] = ["prix" => $prix, "quantite" => $quantite];
        $_SESSION['produits'] = $produits; // Mise à jour session
        echo "<p style='color:green;'>Produit '$nom' ajouté avec succès !</p>";
    } else {
        echo "<p style='color:red;'>Veuillez remplir correctement tous les champs pour ajouter un produit.</p>";
    }
}

if (isset($_POST['rechercher'])) {
    $recherche = $_POST['recherche_nom'];

    if (isset($produits[$recherche])) {
        $produit_trouve = $produits[$recherche];
        echo "<p style='color:blue;'>Produit trouvé : $recherche - Prix : " . $produit_trouve['prix'] . " €, Quantité : " . $produit_trouve['quantite'] . "</p>";
    } else {
        echo "<p style='color:red;'>Produit '$recherche' non trouvé.</p>";
    }
}
?>

<h2>Liste des produits :</h2>
<ul>
<?php
foreach ($produits as $nom => $details) {
    echo "<li><strong>$nom</strong> - Prix : " . $details['prix'] . " €, Quantité : " . $details['quantite'] . "</li>";
}
?>
</ul>

<h2>Ajouter un produit</h2>
<form method="post">
    Nom : <input type="text" name="nom" required><br><br>
    Prix : <input type="number" step="0.01" name="prix" required><br><br>
    Quantité : <input type="number" name="quantite" required><br><br>
    <input type="submit" name="ajouter" value="Ajouter">
</form>

<h2>Rechercher un produit</h2>
<form method="post">
    Nom du produit : <input type="text" name="recherche_nom" required><br><br>
    <input type="submit" name="rechercher" value="Rechercher">
</form>
