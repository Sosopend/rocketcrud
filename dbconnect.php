<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbName = "rocket";
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
?>