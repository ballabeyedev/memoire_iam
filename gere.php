
<?php
session_start(); 

if (!isset($_SESSION['Email'])) {
    header("Location: index.php");
    exit(); 
}
?>
<?php
        include 'connexion.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = isset($_POST['action']) ? $_POST['action'] : '';

            switch ($action) {
                case 'ajouter':
                    header('Location: ajout_user.php');
                    exit;
                case 'supprimer':
                    header('Location: supp_user.php');
                    break;
                case 'modifier':
                    header('Location: modif_user.php');
                    break;
                default:
                    break;
            }
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: -500px;
            margin-left: 500px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #45a049;
        }
        form{
            margin-left: 600px;
            margin-top: -450px;
        }
        .gere img{
            border: 3px solid black;
            width: 300px;
            margin-left: 220px;        
        }
        .gere{
            margin-top: 370px;
        } 
        .actions-form {
            margin-top: 20px;
        }

        .actions-form form {
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .actions-form button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions-form button:hover {
            background-color: #45a049;
        }
        .logo{
            margin-top: -520px;
            height:650px;
            margin-left: -30px;
        }
        .profils{
            margin-top: -400px;
        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: 130px;
        }
        .profil{
            margin-left: 990px;
            margin-top: -40px;
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
    <div class="gere"><img src="image/etudiant.png" style="margin-top: -400px"></div>
    <div class="logo">
        <img src="image/logo2.png">
        <ul>
            <li><a href="admin.php">Menu</a></li>
            <li><a href="parametre.php">Paramètres</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="actions-form">
        <form action="" method="post">
            <a href="javascript:history.go(-1)">RETOUR</a>
            <h3>Veillez choisir l'option que vous voulez !</h3>
            <input type="radio" name="action" id="ajouter" value="ajouter" required>
            <label for="ajouter">Ajouter</label><br><br>
            <input type="radio" name="action" id="supprimer" value="supprimer">
            <label for="supprimer">Supprimer</label><br><br>
            <input type="radio" name="action" id="modifier" value="modifier">
            <label for="modifier">Modifier</label><br><br>

            <button type="submit">Valider</button>
        </form>
    </div>
 
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>