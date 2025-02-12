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
    $creation = $_POST['creation'];
    $vchamp = $_POST['vchamp'];
    $pays = $_POST['pays'];
    if($conn):?>
        <h1>Connection à la BDD réussie</h1>

<?php // Requete d'ajout d'un produit
        if (!empty($_POST["nom"]) && !empty($_POST["creation"]) && !empty($_POST["vchamp"]) && !empty($_POST["pays"])):
            $creation = (int)$_POST['creation'];
            $requete = "INSERT INTO clubs (nom, creation, vchamp, pays) VALUES ('$nom', $creation, $vchamp, '$pays')";
            // executer et stocker  la requête
            $exec = $conn->query($requete);
            if ($exec): header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
                else: header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
                endif; 
            else:
                header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");

        endif;
        endif; ?>

</body>
</html>