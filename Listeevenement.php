<?php
require_once("evenement.php");

class ListeEvenement {
    private $evenements = [];

    public function ajouterEvenement(evenement $e) {
        $this->evenements[] = $e;
    }

    public function afficherTous() {
        if (empty($this->evenements)) {
            echo "Aucun événement à afficher.<br>";
        } else {
            echo '<ul style="list-style-type:none;padding-left: 20px;">';
            foreach ($this->evenements as $e) {
                $e->afficher();
            }
            echo "</ul>";
        }
    }

    // Recherche des événements par titre
    public function rechercherEvenement($motCle) {
        $found = false;
        foreach ($this->evenements as $e) {
            if (stripos($e->get_titre(), $motCle) !== false) {
                $e->afficher();
                $found = true;
            }
        }
        if (!$found) {
            echo "Aucun événement trouvé pour la recherche : $motCle.<br>";
        }
    }
}
?>
