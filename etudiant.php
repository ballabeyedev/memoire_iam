<?php
session_start(); 

if (!isset($_SESSION['Email'])) {
    header("Location: index.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil de l'administrateur</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        .logo{
            margin-top: -120px;
            margin-left: -30px;
            height:620px;
        }
        .profil{
            margin-left: 900px;
            margin-top: -50px;
        }
        .container{
            height:320px
        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: 30px;
        }
        .profil p{
            color: black;
            text-decoration: underline;
        }
        .profil p:hover{
            color: #6A5ACD;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="profil">
        <a href="etudiant.php">
            <span class="profil">
                <img src="image/pjoueur.png" alt="">
                <p><?php echo $_SESSION['Email']; ?> <br>en ligne <input type="radio" name="online" id="online" style="background-color: green;"></p>
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
    <div class="container">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <h1>Bienvenue sur la page d'acceuil <br> ETUDIANT</h1>
        <ul class="nav-links">
            <li><a href="liste_memoire.php">Liste des Memoires</a></li>
            <li><a href="organisation_memoire.php">Recherche memoire (THEME-DOMAINE)</a></li>
            <li><a href="telecharger.php">Telecharger les memoires dispo</a></li>
        </ul>
        <div class="img_admin"><img src="image/etudiant.jpg" alt=""></div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nav-links a').on('click', function(e) {
                e.preventDefault();
                const pageUrl = $(this).attr('href');
                window.location.href = pageUrl;
            });
        });
    </script>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>
