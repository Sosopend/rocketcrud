<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout club</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
<?php
    require_once("./dbconnect.php");
    if($conn):?>
        <h1>Connection à la BDD réussie!</h1>
        <form action="ajout.php" method="post">
            <input type="text" name="nom" placeholder="Nom du Club" >
            <input type="number" name="creation" placeholder="Date de création">
            <input type="number" name="vchamp" placeholder="Nombre de victoire Worlds">
            <input type="text" name="pays" placeholder="Pays d'origine">
            <input type="submit" value="Ajouter un club">
        </form>
<?php endif;?>

</body>
</html>