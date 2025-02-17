<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout à la BDD</title>
</head>

<body>
    <?php
    require_once("./dbconnect.php"); ?>
    <?php

    $nom = htmlspecialchars($_POST['nom']);
    $nomPattern = "/^[a-zA-Z0-9]+$/";
    $errors = [];
    $creation = htmlspecialchars($_POST['creation']);
    $creapattern = "/^(200\d|201\d|202[0-5])$/";
    $patternvchamp = "/^[0-9]\d*$/";
    $vchamp = $_POST['vchamp'];
    $pays = $_POST['pays'];
    if ($conn): ?>
        <h1>Connection à la BDD réussie</h1>

    <?php
        // Il faut tester toutes les conditions d'un coup puis faire du cas par cas
        if (!isset($nom) || empty(trim($nom)) || !preg_match($nomPattern, $nom) || strlen($nom) < 2 || strlen($nom) > 255):
            if (!isset($nom)):
                $errors["nom"] = "Le nom du club est obligatoire";
            endif;
            if (empty(trim($nom))):
                $errors["nom"] = "Le nom du club ne peut pas être vide";
            endif;
            if (!preg_match($nomPattern, $nom)):
                $errors["nom"] = "Le nom du club n'est pas valide";
            endif;
            if (strlen($nom) <= 1):
                $errors["nom"] = "Le nom du club doit contenir au moins 2 caractères";
            endif;
            if (strlen($nom) >= 256):
                $errors["nom"] = "Le nom du club ne peut pas contenir plus de 255 caractères";
            endif;
        endif;

        if (empty(trim($creation)) || !isset($creation) || !preg_match($creapattern, $creation) || strlen($creation) != 4):
            $errors["creation"] = "";

            if (empty(trim($creation))):
                $errors["creation"] .= "le champs creation n'est pas renseigné";
            endif;
            if (!isset($creation)):
                $errors["creation"] .= "le champs creation est vide";
            endif;
            if (!preg_match($creapattern, $creation)):
                $errors["creation"] .= "le champs creation n'est pas valide";
            endif;
            if (strlen($creation) != 4):
                $errors["creation"] .= "le champs creation doit contenir 4 chiffres";
            endif;
        endif;

        if (empty(trim($vchamp)) || !isset($vchamp) || !preg_match($patternvchamp, $vchamp)):
            $errors["vchamp"] = "";

            if (empty(trim($vchamp))):
                $errors["vchamp"] .= "le champs vchamp n'est pas renseigné";
            endif;
            if (!isset($vchamp)):
                $errors["vchamp"] .= "le champs vchamp est vide";
            endif;
            if (!preg_match($patternvchamp, $vchamp)):
                $errors["vchamp"] .= "le champs vchamp n'est pas valide";
            endif;
        endif;

        if (empty($errors)):
            $creation = htmlspecialchars($_POST['creation']);
            $vchamp = htmlspecialchars($_POST['vchamp']);
            $requete = "INSERT INTO clubs (nom, creation, vchamp, pays) VALUES (:nom, :creation, :vchamp, '$pays')";
            //prepa de la requete
            $stmt = $conn->prepare($requete);
            //binder les valeurs
            $stmt->bindParam(':creation', $creation);
            $stmt->bindParam(':vchamp', $vchamp);
            $stmt->bindParam(':nom', $nom);
            // executer et stocker  la requête
            $exec = $stmt->execute();
            header("Refresh: 5; URL=http://cours-php.test/rocket/rocketcrud/index.php");
        else:
            // gere une boucle foreach pour lister chaque erreur du tableau $errors
            foreach ($errors as $key => $value): ?>
                <p><?= $value ?></p>
        <?php
            endforeach;
        endif;
    endif;?> 
</body>

</html>
