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
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        .tab{
            margin-left: 600px;
            margin-top: -200px;
            width:50%;
        }
        th{
            background-color: #B03A2E;
        }
        .search-container{
            margin-left: 300px;
            margin-top: -750px;
        }
        .search-container button{
            background-color: #FF1493;
        }
        .search-container button:hover{
            background-color: #48D1CC;
        }
        .logo{
            margin-top: -130px;
            height:800px;
            margin-left: -30px;

        }
        .image img{
            margin-left: 300px;
            margin-top: 50px;
            height: 200px
        }
        .profil{
            margin-left: 960px;
            margin-top: -60px;
        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: 60px;
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
    <div class="search-container">
        <form action="telecharger.php" method="GET">
            <input type="text" placeholder="Rechercher un mémoire..." name="search">
            <button type="submit">Recherche</button>
        </form>
    </div>
    <div class="image">
        <img src="image/rechercher.jpg" alt="">
    </div>

    <?php
    $servername = "mysql-balladev.alwaysdata.net";
    $username = "balladev_iam";
    $password = "devweb2024@";
    $dbname = "balladev_iam";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['search'])) {
        $search_term = mysqli_real_escape_string($conn, $_GET['search']);
        $sql = "SELECT m.titre, m.description, m.fichier, m.date_publication FROM memoires m INNER JOIN themes t ON m.theme_id = t.theme_id WHERE t.nom_theme LIKE '%$search_term%' OR m.titre LIKE '%$search_term%'";
        $result = $conn->query($sql);

        echo "<table border='1' class='tab'>";
        echo "<tr><th>Titre</th><th>Description</th><th>Date de publication</th><th>Télécharger</th></tr>";

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row["titre"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["date_publication"]) . "</td>";
                echo "<td><a href='download.php?file=" . urlencode($row["fichier"]) . "'>Télécharger</a></td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>0 résultats</td></tr>";
        }

        echo "</table>";
    }

    $conn->close();
    ?>

    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>

</body>
</html>
