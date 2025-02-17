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
    $creation = $_POST['creation'];
    $vchamp = $_POST['vchamp'];
    $pays = $_POST['pays'];
    $nomPattern = "/^[a-zA-Z0-9]+$/";
    $errors = [];
    if ($conn): ?>
        <h1>Connection à la BDD réussie</h1>

        <?php
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
        if (empty($errors["nom"])):
            $requete = "INSERT INTO clubs (nom) VALUES (:nom)";
            $exec = $conn->prepare($requete);
            $exec->bindParam('nom', $nom, PDO::PARAM_STR);
            $result = $exec->execute();
            if ($result):
                header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
            else:
                header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
            endif;
        else:
            foreach ($errors as $key => $value): ?>
                <p><?= $value ?></p>
    <?php
            endforeach;
        endif;
    else:
        header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
    endif; ?>

</body>

</html>