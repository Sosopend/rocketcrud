<?php
// var_dump($_POST);
$nom = htmlspecialchars($_POST['nom']);
$nomPattern = "/^[a-zA-Z0-9]+$/";
$errors = [];
$creation = htmlspecialchars($_POST['creation']);
$creapattern = "/^(200\d|201\d|202[0-5])$/";
$patternvchamp = "/^[0-9]\d*$/";
$patternpays = "/^[A-Z]{1,3}$/";
$vchamp = intval($_POST['vchamp']);
$pays = htmlspecialchars($_POST['pays']);
$prodId = $_POST["id"];
require_once("./dbconnect.php");
if ($conn):
?>
    <h1>Connection à la BDD réussie</h1>
<?php
        // Il faut tester toutes les conditions d'un coup puis faire du cas par cas
        if (!isset($nom) || empty(trim($nom)) || !preg_match($nomPattern, $nom) || strlen($nom) < 2 || strlen($nom) > 255):

            $errors["nom"] = isset($errors["nom"]) ? $errors["nom"] : "";

            if (!isset($nom)):
                $errors["nom"] .= "Le nom du club est obligatoire, ";
            endif;
            if (empty(trim($nom))):
                $errors["nom"] .= "Le nom du club ne peut pas être vide, ";
            endif;
            if (!preg_match($nomPattern, $nom)):
                $errors["nom"] .= "Le nom du club n'est pas valide, ";
            endif;
            if (strlen($nom) <= 1):
                $errors["nom"] .= "Le nom du club doit contenir au moins 2 caractères, ";
            endif;
            if (strlen($nom) >= 256):
                $errors["nom"] .= "Le nom du club ne peut pas contenir plus de 255 caractères, ";
            endif;
        endif;

        if (empty(trim($creation)) || !isset($creation) || !preg_match($creapattern, $creation) || strlen($creation) != 4):
            $errors["creation"]= "Le champs creation n'est pas valide";

        //$errors["creation"] = "";
        //     if (empty(trim($creation))):
        //         $errors["creation"] .= "le champs creation n'est pas renseigné, ";
        //     endif;
        //     if (!isset($creation)):
        //         $errors["creation"] .= "le champs creation est vide, ";
        //     endif;
        //     if (!preg_match($creapattern, $creation)):
        //         $errors["creation"] .= "le champs creation n'est pas valide, ";
        //     endif;
        //     if (strlen($creation) != 4):
        //         $errors["creation"] .= "le champs creation doit contenir 4 chiffres, ";
        //     endif;
        endif;

        if (!isset($vchamp) || $vchamp < 0):
            $errors["vchamp"]= "Le champs vchamp n'est pas valide";

            //$errors["vchamp"] = "";
            // if (empty(trim($vchamp))):
            //     $errors["vchamp"] .= "le champs vchamp n'est pas renseigné, ";
            // endif;
            // if (!isset($vchamp)):
            //     $errors["vchamp"] .= "le champs vchamp est vide, ";
            // endif;
            // if (!preg_match($patternvchamp, $vchamp)):
            //     $errors["vchamp"] .= "le champs vchamp n'est pas valide, ";
            // endif;
        endif;
        if(!isset($pays) || empty(trim($pays)) || !preg_match($patternpays, $pays) || strlen($pays) < 3 || strlen($pays) > 3):
            $errors["pays"]= "Le champs pays n'est pas valide";
            //$errors["pays"] = "";
            // if (!isset($pays)):
            //     $errors["pays"] .= "le champs pays est vide, ";
            //     endif;
            // if (empty(trim($pays))):
            //     $errors["pays"] .= "le champs pays n'est pas vide, ";
            //     endif;
            // if (!preg_match($patternpays, $pays)):
            //     $errors["pays"] .= "le champs pays n'est pas valide, ";
            //     endif;
            // if (strlen($pays) < 3):
            //     $errors["pays"] .= "le champs pays doit contenir 3 caractères, ";
            //     endif;
            // if (strlen($pays) > 3):
            //     $errors["pays"] .= "le champs pays doit contenir 3 caractères, ";
            //     endif;
            // // verifier si uniquement en maj
            // if (preg_match('/[a-z]/', $pays)):
            //     $errors["pays"] .= "le champs pays doit contenir que des MAJ";
            //     endif;
            endif;


        if (empty($errors)):
            $hash = password_hash($pays, PASSWORD_ARGON2ID);
            $creation = htmlspecialchars($_POST['creation']);
            $vchamp = htmlspecialchars($_POST['vchamp']);
            $pays = htmlspecialchars($_POST['pays']);
            $nom = htmlspecialchars($_POST['nom']);
            $requete = "UPDATE clubs SET nom = :nom, creation = :creation, vchamp = :vchamp, pays = :pays WHERE id = :id";
    
            //prepa de la requete
            $stmt = $conn->prepare($requete);
            //binder les valeurs
            $stmt->bindParam(':creation', $creation);
            $stmt->bindParam(':vchamp', $vchamp);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':pays', $hash);
            $stmt->bindParam(':id', $prodId, PDO::PARAM_INT);

            // executer et stocker  la requête
            $exec = $stmt->execute();
            if ($exec) {
                header("Location: http://cours-php.test/rocket/rocketcrud/index.php");
                exit();
            } else {
                echo "<p>Erreur lors de la mise à jour.</p>";
            }
        else:
            // gere une boucle foreach pour lister chaque erreur du tableau $errors
            foreach ($errors as $key => $value): ?>
                <p><?= $value ?></p>
        <?php
            endforeach;
        endif;
    endif;
$conn = null;
?> 
</body>

</html>

