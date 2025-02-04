<?php
    require_once("./html_base/header.php");
    require_once("./dbconnect.php");

    if ($conn): 
        <?php

       
    
    if($conn):
    
        $userId = $_POST["identifiant"];
    
        
        $requete = "DELETE FROM clubs WHERE id = $";
    
        
        $exec = $conn->query($requete);
    ?>
    
    <?php endif; ?>
    ?>