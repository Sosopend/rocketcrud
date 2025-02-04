    <?php
    require_once("./html_base/header.php");
    require_once("./dbconnect.php");

    if ($conn): ?>
        <h1>Connexion à la BDD réussie!</h1>
        <?php
        $requete = "SELECT * FROM clubs";
        $exec = $conn->query($requete);
        $result = $exec->fetchAll(PDO::FETCH_ASSOC); ?>
        <hr>
        <?php foreach ($result as $key => $value):
        ?>
            <h2><?php echo $value["nom"]; ?></h2>
            <ul>
                <li><?php echo "<strong>Date</strong> : " . $value["creation"] ?></li>
                <li><?php echo "<strong>Nombe de victoire Worlds</strong> : " . $value["vchamp"] ?></li>
                <li><?php echo "<strong>Pays</strong> : " . $value["pays"] ?></li>
            </ul>
            <hr>
    <?php
        endforeach;
    endif;
    require_once("./html_base/footer.php");
    ?>
