<?php
   
    require_once("./dbconnect.php");

    if ($conn): 
    
        $clubsId = $_POST["identifiant"];
    
       $requete = "DELETE FROM clubs WHERE id = $clubsId";
        $exec = $conn->query($requete);
    ?>
    
    <?php endif;
    ?>
    