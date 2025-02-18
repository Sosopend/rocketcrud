<?php

session_start();
$token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $token;
require_once("./html_base/header.php");
require_once("./dbconnect.php");
$prodId = $_POST["id"];
if ($conn):
    $requeteFind = "SELECT * FROM clubs WHERE id = $prodId";
    $exec = $conn->query($requeteFind);
    $result = $exec->fetch(PDO::FETCH_ASSOC);
    // var_dump($result);
?>
    <form action="./modif.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="text" name="nom" value="<?php echo $result["nom"] ?>">
        <input type="number" name="creation" value="<?php echo $result["creation"] ?>">
        <input type="number" name="vchamp" value="<?php echo $result["vchamp"] ?>">
        <input type="text" name="pays" value="<?php echo $result["pays"] ?>">
        <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
        <input type="submit" value="Modifier les informations">
    </form>
<?php
endif;
require_once("./html_base/footer.php");
?>