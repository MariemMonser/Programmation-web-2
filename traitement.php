<?php
require_once("Listeevenement.php");
// Vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];

    // Créer un nouvel événement
    $nouvelEvenement = new evenement($titre, $date, $lieu);

    // Créer la liste des événements
    $liste = new ListeEvenement();

    // Ajouter l'événement à la liste
    $liste->ajouterEvenement($nouvelEvenement);

    // Rediriger vers la page principale pour afficher les événements
    header("Location: main.php");  // Redirection vers main.php après ajout
}
?>
