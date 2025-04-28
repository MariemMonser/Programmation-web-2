<?php
class evenement {
    private $titre;
    private $date;
    private $lieu;

    public function __construct($titre, $date, $lieu) {
        $this->titre = $titre;
        $this->date = $date;
        $this->lieu = $lieu;
    }

    public function get_titre() {
        return $this->titre;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLieu() {
        return $this->lieu;
    }

    public function afficher() {
        echo "<li> {$this->titre} - le {$this->date} à {$this->lieu}</li>";
    }

    public function getDateFormat() {
        return date('d F Y', strtotime($this->date));
    }
}
?>
