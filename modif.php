<?php
// var_dump($_POST);
$nom = $_POST["nom"];
$creation = $_POST["creation"];
$victoire = $_POST["vchamp"];
$pays = $_POST["pays"];
$prodId = $_POST["id"];
require_once("./dbconnect.php");
if ($conn):
    $requete = "UPDATE clubs SET nom = '$nom', creation = $creation, vchamp = $victoire, pays = '$pays' WHERE id = $prodId";
    $exec = $conn->query($requete);
    if ($exec):
        header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
    endif;
endif;
?>
