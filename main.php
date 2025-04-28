<?php
header('content-type:text/html;charset=utf-8');
require_once("Listeevenement.php");  // Assurez-vous que le fichier 'Listenevenement.php' est dans le même dossier que ce fichier

// Création des événements
$e1 = new evenement("concert de jazz", "2025-05-10", "théâtre de Bizerte");
$e2 = new evenement("atelier de peinture", "2025-06-10", "centre culturel");
$e3 = new evenement("conférence PHP", "2025-07-10", "université de Bizerte");

// Création de la liste des événements
$liste = new ListeEvenement();

// Ajout des événements à la liste
$liste->ajouterEvenement($e1);
$liste->ajouterEvenement($e2);
$liste->ajouterEvenement($e3);

echo "....Liste des événements ..<br>";
// Affichage de tous les événements
$liste->afficherTous();

// Recherche d'événements par mot-clé
echo "Recherche : 'PHP'-----<br>";
$liste->rechercherEvenement("PHP");
?>
