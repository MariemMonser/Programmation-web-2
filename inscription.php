<?php 

$errors = array(
    "cin" => "",
    "nom" => "",
    "prenom" => "",
    "email" => "",
    "type" => "",
    "option" => ""
);

$cin = $nom = $prenom = $email = $type = $option = "";

// Vérification du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CIN
    $cin = isset($_POST["cin"]) ? trim($_POST["cin"]) : "";
    if (empty($cin)) {
        $errors["cin"] = "Le CIN est requis.";
    } elseif (!preg_match("/^[0-9]{8}$/", $cin)) {
        $errors["cin"] = "Le CIN doit contenir exactement 8 chiffres.";
    }

    // NOM
    $nom = isset($_POST["nom"]) ? trim($_POST["nom"]) : "";
    if (empty($nom)) {
        $errors["nom"] = "Le nom est requis.";
    }

    // PRENOM
    $prenom = isset($_POST["prenom"]) ? trim($_POST["prenom"]) : "";
    if (empty($prenom)) {
        $errors["prenom"] = "Le prénom est requis.";
    }

    // EMAIL
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    if (empty($email)) {
        $errors["email"] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format d'email invalide.";
    }

    // TYPE DE FORMATION
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    if ($type == "#" || empty($type)) {
        $errors["type"] = "Veuillez choisir un type de formation.";
    }

    // OPTION
    $option = isset($_POST["option"]) ? $_POST["option"] : "";
    if (empty($option)) {
        $errors["option"] = "Veuillez sélectionner une option.";
    }

    // Si pas d'erreurs, traitement
    if (empty($errors)) {
        echo "<p style='color: green;'>Formulaire soumis avec succès !</p>";

        // Affichage récapitulatif
        echo "<h2>📝 Données soumises :</h2>";
        echo "<ul>";
        echo "<li><strong>CIN :</strong> " . htmlspecialchars($cin) . "</li>";
        echo "<li><strong>Nom :</strong> " . htmlspecialchars($nom) . "</li>";
        echo "<li><strong>Prénom :</strong> " . htmlspecialchars($prenom) . "</li>";
        echo "<li><strong>Email :</strong> " . htmlspecialchars($email) . "</li>";
        echo "<li><strong>Type de formation :</strong> " . htmlspecialchars($type) . "</li>";
        echo "<li><strong>Option :</strong> " . htmlspecialchars($option) . "</li>";
        echo "</ul>";

        // Sauvegarde dans un fichier texte
        $ligne = "$cin | $nom | $prenom | $email | $type | $option\n";
        file_put_contents("inscriptions.txt", $ligne, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'inscription</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="email"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        label {
            font-weight: bold;
        }
        fieldset {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<form method="post">
    <h2>Inscription à la formation</h2>

    <label>CIN :</label>
    <input type="text" name="cin" value="<?php echo htmlspecialchars($cin); ?>">
    <div class="error"><?php echo isset($errors["cin"]) ? $errors["cin"] : ""; ?></div>

    <label>Nom :</label>
    <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
    <div class="error"><?php echo isset($errors["nom"]) ? $errors["nom"] : ""; ?></div>

    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>">
    <div class="error"><?php echo isset($errors["prenom"]) ? $errors["prenom"] : ""; ?></div>

    <label>Email :</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <div class="error"><?php echo isset($errors["email"]) ? $errors["email"] : ""; ?></div>

    <label>Type de formation :</label>
    <select name="type">
        <option value="#">Choisir une formation</option>
        <option value="java" <?php if ($type == "java") echo "selected"; ?>>Java</option>
        <option value="php" <?php if ($type == "php") echo "selected"; ?>>PHP</option>
        <option value="rubby" <?php if ($type == "rubby") echo "selected"; ?>>Rubby</option>
    </select>
    <div class="error"><?php echo isset($errors["type"]) ? $errors["type"] : ""; ?></div>

    <fieldset>
        <legend>Option :</legend>
        <input type="radio" name="option" value="bac" <?php if ($option == "bac") echo "checked"; ?>> <label>Bac</label><br>
        <input type="radio" name="option" value="1ere cycle" <?php if ($option == "1ere cycle") echo "checked"; ?>> <label>1ère cycle</label><br>
        <input type="radio" name="option" value="2eme cycle" <?php if ($option == "2eme cycle") echo "checked"; ?>> <label>2ème cycle</label><br>
        <div class="error"><?php echo isset($errors["option"]) ? $errors["option"] : ""; ?></div>
    </fieldset>

    <input type="submit" name="valider" value="Valider">
</form>

</body>
</html>
