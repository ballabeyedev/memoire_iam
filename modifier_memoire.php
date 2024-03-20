<?php
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: index.php");
    exit();
}

include 'connexion.php'; 

$id_memoire = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM memoires WHERE id_memoire = :id_memoire";
$stmt = $connect->prepare($sql);
$stmt->execute(['id_memoire' => $id_memoire]);
$memoire = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$memoire) {
    echo "Mémoire non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Mémoire</title>
    <link rel="stylesheet" href="admin.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    form {
        max-width: 600px;
        margin: 20px auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: -600px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    label {
        display: block;
        margin: 10px 0 5px;
    }

    input[type=text],
    input[type=date],
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    textarea {
        height: 50px;
    }
    footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
    }
    footer{
        margin-top: 50px;
    }
    .profils img {
        height: 20px;
        border: 2px solid black;
        border-radius: 30px;
        margin-top: 4px;
    }

    .profil {
        margin-left: 990px;
        margin-top: -20px;
    }
    .logo{
        margin-top: -210px;
        margin-left: -40px;
        height:700px
    }
</style>
</head>
<body>
<div class="profil">
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
            <li>
                <a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));">
                    <button type="submit" class="disconnect">Déconnexion</button>
                </a>
            </li>
        </ul>
    </div>
    <form action="traitement_modifier_memoire.php" method="post">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <input type="hidden" name="id_memoire" value="<?php echo $memoire['id_memoire']; ?>">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($memoire['titre']); ?>"><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($memoire['description']); ?></textarea><br>
        <label for="date_publication">Date de publication:</label>
        <input type="date" id="date_publication" name="date_publication" value="<?php echo $memoire['date_publication']; ?>"><br>
        <label for="fichier">Fichier:</label>
        <input type="file" name="fichier" id="fichier" value="<?php echo $memoire['fichier']; ?>"><br>
        <input type="submit" value="Modifier">
    </form>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>
