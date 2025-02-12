    <?php
    /*
    Karl: Création de la requête ajout, travail des redirections, début du CSS
    Sofiane: Création de la DB, repo Github, Création de la requête update, Participation à la création de la requête read
    Bachir: Participation à la requête read, Création de la requête delete, Création de HTML BASE, Création de dbconnect
    */ 
    require_once("./html_base/header.php");
    require_once("./dbconnect.php");

    if ($conn): ?>
        <h2>Connexion à la BDD réussie!</h2>
        <?php
        $requete = "SELECT * FROM clubs";
        $exec = $conn->query($requete);
        $result = $exec->fetchAll(PDO::FETCH_ASSOC); ?>
        <div>
        <?php foreach ($result as $key => $value):
        ?>
            <div class="club">
            <h2><?php echo $value["nom"]; ?></h2>
            <ul>
                <li><?php echo "<strong>Date</strong> : " . $value["creation"] ?></li>
                <li><?php echo "<strong>Nombe de victoire Worlds</strong> : " . $value["vchamp"] ?></li>
                <li><?php echo "<strong>Pays</strong> : " . $value["pays"] ?></li>
            </ul>
            <form action="./form-modif.php" method="post">
                <input type="hidden" name="id" value="<?php echo $value["id"] ?>">
                <input type="submit" value="Modifier les informations">
            </form>
            <form action="./delete.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $value["id"]; ?>">
                <input type="submit" value="Supprimer ce club">
            </form>
            </div>
        <?php
        endforeach; ?>
        <a href="http://cours-php.test/rocket/rocketcrud/form-ajout.php">Ajouter un club</a>
        </div>
    <?php endif;
    require_once("./html_base/footer.php");
    ?>