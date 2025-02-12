<?php
   
    require_once("./dbconnect.php");

    if ($conn): 
    
        $clubsId = $_POST["identifiant"];
    
       $requete = "DELETE FROM clubs WHERE id = $clubsId";
        $exec = $conn->query($requete);
        $exec = $conn->query($requete);
            if ($exec): header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
                else: header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");
                endif; 
            else:
                header("Refresh: 0; URL=http://cours-php.test/rocket/rocketcrud/index.php");

        endif;?>
    