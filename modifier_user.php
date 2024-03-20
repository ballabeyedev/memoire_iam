<?php
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: index.php");
    exit();
}

require 'connexion.php';

$id_utilisateur = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_utilisateur <= 0) {
    echo "ID utilisateur invalide.";
    exit;
}

$sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = ?";
$stmt = $connect->prepare($sql);
$stmt->execute([$id_utilisateur]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    echo "Utilisateur non trouvé.";
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
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-top: -500px;
    }

    form div {
        margin-bottom: 15px;
        position: relative;
    }

    form label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    form input[type="text"],
    form input[type="email"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Pour inclure padding dans la largeur */
    }

    /* Style du bouton de soumission */
    form button[type="submit"] {
        padding: 10px 15px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    form button[type="submit"]:hover {
        background: #0056b3;
    }

    /* Ajout d'un peu d'animation au focus */
    form input[type="text"]:focus,
    form input[type="email"]:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    }

    /* Style pour positionner le label à l'intérieur des champs de saisie */
    form label.inside-input {
        position: absolute;
        top: 10px;
        left: 10px;
        color: #aaa;
        transition: all 0.3s;
        pointer-events: none;
    }

    form input[type="text"]:focus + label.inside-input,
    form input[type="email"]:focus + label.inside-input {
        top: -10px;
        left: 10px;
        font-size: 12px;
        color: #007bff;
    }

    form input[type="text"]:valid + label.inside-input,
    form input[type="email"]:valid + label.inside-input {
        top: -10px;
        left: 10px;
        font-size: 12px;
        color: #007bff;
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
    <form action="traitement_modifier_user.php" method="post">
        <input type="hidden" name="id_utilisateur" value="<?= htmlspecialchars($utilisateur['id_utilisateur']) ?>">
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>
        </div>
        <div>
            <button type="submit">Modifier</button>
        </div>
    </form>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>
