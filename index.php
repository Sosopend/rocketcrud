<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de données clubs</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
<?php
    require_once("./dbconnect.php");
    if($conn):?>
        <h1>Connection à la BDD réussie!</h1>
        <a href="http://cours-php.test/rocket/rocketcrud/form-ajout.php">Ajouter un club</a>
        
<?php endif;?>

</body>
</html>