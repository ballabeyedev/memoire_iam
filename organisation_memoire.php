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
        .search-container {
            text-align: center;
            margin: 20px 0;
            margin-top: -590px;
            margin-left: -180px;
        }

        .search-container input[type=text] {
            padding: 10px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
            width: 80%;
            max-width: 300px;
        }

        .search-container button {
            padding: 10px;
            margin-top: 8px;
            background: #333;
            color: white;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }

        .search-container button:hover {
            background: #555;
        }
        .logo{
            margin-top: -120px;
            margin-left: -40px;
            height: 650px
        }
        .image img{
            margin-left: 200px;
            height: 400px;
            border: 1px solid black;
        }
        table {
                width: 30%;
                margin: 20px auto;
                border-collapse: collapse;
                background-color: #fff;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                margin-left: 820px;
                margin-top: -400px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: 100px;
        }
        .profil{
            margin-left: 960px;
            margin-top: -60px;
        }
        .retour{
            margin-top: -500px;
            margin-left: 20px;
        }
        .truc a{
            margin-left: -100px;
        }
        .truc{
            text-decoration: none;
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
        <a href="javascript:history.go(-1)" class="retour">RETOUR</a>
        <img src="image/logo2.png">
        <ul class="truc">
            <li><a href="etudiant.php">Menu</a></li>
            <li><a href="parametre.php">Paramètres</a></li>
            <li><a href="#">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="search-container">
        <form action="search.php" method="GET">
            <input type="text" placeholder="Rechercher un mémoire par domaine..." name="search">
            <button type="submit">Recherche</button>
        </form>
    </div>
    <div class="image">
        <img src="image/theme.jpg" alt="">
    </div>
    <div class="tb">
        <?php
            $servername = "mysql-balladev.alwaysdata.net";
            $username = "balladev_iam";
            $password = "devweb2024@";
            $dbname = "balladev_iam";

        try {
            $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "SELECT d.nom_domaine AS domaine, COUNT(m.id_memoire) AS nombre_memoires, GROUP_CONCAT(m.titre SEPARATOR '<br>') AS memoires FROM domaine d LEFT JOIN memoires m ON d.domaine_id = m.domaine_id GROUP BY d.domaine_id";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>
            <table>
                <tr>
                    <th>DOMAINE</th>
                    <th>NOMBRE DE MÉMOIRES</th>
                </tr>
                <?php foreach ($resultats as $ligne) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ligne['domaine']); ?></td>
                        <td><?php echo htmlspecialchars($ligne['nombre_memoires']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php

        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
        ?>

        </table>
    </div>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>

</body>
</html>
