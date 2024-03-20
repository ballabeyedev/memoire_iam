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
    if (
        isset($_POST['titre'], $_POST['description'], $_FILES['fichier'], $_POST['date'], $_POST['theme'], $_POST['domaine'])
    ) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $theme = $_POST['theme'];
        $domaine = $_POST['domaine'];

        $file = $_FILES['fichier'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        if ($fileError === 0) {
            $uploadDir = 'fichier_memoire/';
            $uploadPath = $uploadDir . $fileName;
            move_uploaded_file($fileTmpName, $uploadPath);

            $query = $connect->prepare("INSERT INTO memoires (titre, description, fichier, date_publication, theme_id, domaine_id) VALUES (?, ?, ?, ?, ?, ?)");
            $testquery = $query->execute([$titre, $description, $uploadPath, $date, $theme, $domaine]);

            if ($testquery) {
                header("Location: admin.php");
                exit;
            } else {
                echo "Erreur lors de l'insertion : " . $query->errorInfo()[2];
            }
        } else {
            echo "Erreur lors de l'upload du fichier.";
        }
    } else {
        echo "Les données nécessaires ne sont pas définies";
    }
}

$themesQuery = $connect->query("SELECT * FROM themes");
$themes = $themesQuery->fetchAll(PDO::FETCH_ASSOC);

$domainesQuery = $connect->query("SELECT * FROM domaine");
$domaines = $domainesQuery->fetchAll(PDO::FETCH_ASSOC);
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
        .logo{
            margin-top: -180px;
            margin-left: -30px;
            height: 680px;
        }
        .tous{
            margin-left: 90px;
            margin-top: -600px;
        }
        .tous h3{
            margin-left: 500px;
            text-decoration: underline;
        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: 10px;
        }
        .ins img{
            margin-left: 150px;
        }
        .tous a{
            margin-left: 200px;
        }
        .profil{
            margin-left: 990px;
            margin-top: -40px;
        }
        hr{
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="profil">
        <a href="etudiant.php">
            <span class="profil">
                <img src="image/pjoueur.png" alt="">
                <p><?php echo $_SESSION['Email']; ?> <br>en ligne </p>
            </span>
        </a>
    </div>
    <div class="logo">
        <img src="image/logo2.png">
        <ul>
            <li><a href="etudiant.php">Menu</a></li>
            <li><a href="parametre.php">Paramètres</a></li>
            <li><a href="#">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="tous">
        <hr class="hr">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <h3>AJOUT DE MEMOIRES</h3>
        <div class="ins"><img src="image/am.png"></div>
        <form class="login" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" id="titre" placeholder="Titre" required><br>
        <input type="text" name="description" id="description" placeholder="Description" required><br>
        <input type="file" name="fichier" id="fichier" required><br>
        <input type="date" name="date" id="date" placeholder="Date Publication" required><br>
        <select name="theme" id="theme" required>
            <option value="" disabled selected>Sélectionner un thème</option>
            <?php foreach ($themes as $theme) : ?>
                <option value="<?= $theme['theme_id']; ?>"><?= $theme['nom_theme']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <select name="domaine" id="domaine" required>
            <option value="" disabled selected>Sélectionner un domaine</option>
            <?php foreach ($domaines as $domaine) : ?>
                <option value="<?= $domaine['domaine_id']; ?>"><?= $domaine['nom_domaine']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Ajouter →</button>
</form>

    </div>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>
