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
    $nom = $_POST['nom'];
    $creation = htmlspecialchars($_POST['creation']);
    $creapattern = "/^(200\d|201\d|202[0-5])$/";
    $vchamp = $_POST['vchamp'];
    $pays = $_POST['pays'];
    if ($conn): ?>
        <h1>Connection à la BDD réussie</h1>

    <?php // Requete d'ajout d'un produit
        if (!empty($_POST["nom"]) && (isset($_POST['creation']) && !empty(trim($creation)) && preg_match($creapattern, $creation) && strlen($creation) == 4) && !empty($_POST["vchamp"]) && !empty($_POST["pays"])):
            $creation = htmlspecialchars($_POST['creation']);
            $requete = "INSERT INTO clubs (nom, creation, vchamp, pays) VALUES ('$nom', :creation, $vchamp, '$pays')";
            //prepa de la requete
            $stmt = $conn->prepare($requete);
            //binder les valeurs
            $stmt->bindParam(':creation', $creation);
            // executer et stocker  la requête
            $exec = $stmt->execute();
            if ($exec): header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
            else: header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
            endif;
        else:
            if ($creation < 2000):
                echo "Erreur!!";
                echo "La date de création du Club doit être après 2000";
            elseif ($creation > 2025):
                echo "La date de création du Club doit être avant 2026";
            else:
                header("Refresh: 5; URL=http://cours-php.test/rocket/rocketcrud/index.php");

            endif;

        endif;
    endif; ?>

</body>

</html>