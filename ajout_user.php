<?php
session_start(); 

if (!isset($_SESSION['Email'])) {
    header("Location: index.php");
    exit(); 
}
?>
<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['mot_de_passe'], $_POST['confirm_passwd'], $_POST['type_utilisateur'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['mail'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $confirm_passwd = $_POST['confirm_passwd'];
        $type_utilisateur = $_POST['type_utilisateur'];

        if ($mot_de_passe !== $confirm_passwd) {
            echo "<div class='unique'>Les mots de passe ne correspondent pas</div>";
        }else {
            $check_query = "SELECT * FROM utilisateurs WHERE email = :login";
            $stmt = $connect->prepare($check_query);
            $stmt->execute([':login' => $email]);
            if ($stmt->rowCount() > 0) {
                echo "<div class='unique'>Le login existe déjà. Veuillez choisir un autre login.</div>";
            }else {
                $query = $connect->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, type_utilisateur) VALUES (?, ?, ?, ?, ?)");
                $testquery = $query->execute([$nom, $prenom, $email, $mot_de_passe, $type_utilisateur]);

                if ($testquery) {
                    header("Location: admin.php");
                    exit;
                } else {
                    echo "Erreur lors de l'insertion : " . $query->errorInfo()[2];
                }
            }
        }
        } else {
            echo "Les données nécessaires ne sont pas définies";
        }
    }

$typeQuery = $connect->query("SELECT DISTINCT type_utilisateur FROM utilisateurs");
$type_utilisateurs = $typeQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="inscription.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .tous{
            margin-left: 300px;
            margin-top: -550px;
        }
        .tous h3{
            margin-left: 300px;
            text-decoration: underline;
        }
        .logo{
            margin-top: -120px;
            height: 620px;
            margin-left: -30px;
        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: -15px;
        }
        .unique {
        background-color: #ffcccc; 
        color: #cc0000;
        padding: 10px; 
        border: 1px solid #cc0000; 
        border-radius: 5px; 
        margin-bottom: 10px; 
        /* margin-top: 400px; */
        margin-left: 470px;
        margin-right: 300px; 
    } 
    .b1{
            height:10px;
            background-color: #BC8F8F;
            margin-right: 700px;
            margin-left: 310px;
        }
        .b2{
            height:10px;
            background-color: #FFDEAD;
            margin-right: 700px;
            margin-left: 310px;   
        }
        .b3{
            height:10px;
            background-color: #B0E0E6;
            margin-right: 700px;
            margin-left: 310px;
        }
        .barre1{
            margin-top: -90px;
            margin-left: -40px;
            margin-right: 40px;
        }
    </style>
</head>
<body>
    <div class="profils">
        <a href="etudiant.php">
            <span class="profil">
                <p><?php echo $_SESSION['Email']; ?> <br>en ligne </p>
            </span>
        </a>
    </div>
    <div class="logo">
        <img src="image/logo2.png">
        <ul>
            <li><a href="admin.php">Menu</a></li>
            <li><a href="parametre.php">Paramètres</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="header">
    </div>
    <div class="tous">
        <h3>AJOUTE UTILISATEUR</h3>
        <hr class="hr">
        <div class="ins">
            <img src="image/au.png" alt="">
        </div>
        <form class="login" method="post" action="ajout_user.php">
            <a href="javascript:history.go(-1)">RETOUR</a>
            <input type="text" name="nom" id="nom" placeholder="Nom" required><br>
            <input type="text" name="prenom" id="prenom" placeholder="Prenom" required><br>
            <input type="text" name="mail" id="mail" placeholder="Mail" required><br>
            <input type="text" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" required><br>
            <input type="text" name="confirm_passwd" id="confirm_passwd" placeholder="Confirme mot de passe" required><br>
            <select name="type_utilisateur" id="type_utilisateur" required>
                <option value="" disabled selected>Sélectionner un type utilisateur</option>
                <?php foreach ($type_utilisateurs as $type_utilisateur) : ?>
                    <option value="<?= $type_utilisateur['type_utilisateur']; ?>"><?= $type_utilisateur['type_utilisateur']; ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <button type="submit">Ajouter →</button>
        </form>
    </div>
    <div class="barre1">
        <hr class="b1">
        <hr class="b2">
        <hr class="b3">
    </div>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>
