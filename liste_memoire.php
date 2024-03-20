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
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: -290px;
            margin-left: 600px;
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
                margin-left: 700px;
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
        .logo{
            margin-top: -90px;
            margin-left: -30px;
            height: 690px
        }
        .image img{
            margin-left: 200px;
            height:200px;
            border: 3px solid black;
            margin-top: -20px;
            border-radius: 30px

        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: -20px;
        }
        .image{
            margin-top: 120px;
        }
        .text{
            margin-left: 600px;
            margin-top: -650px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .text p {
            animation: fadeIn 2s ease-in-out; 
            text-decoration: underline;
            font-size: 20px;
            margin-top: -200px;
        }
        .text a{
            margin-left: -100px;
        }
        .profil{
            margin-left: 900px;
            margin-top: -60px;
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
            <li><a href="">Menu</a></li>
            <li><a href="#">Paramètres</a></li>
            <li><a href="#">Profil</a></li>
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit"  class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="text">
        <p>LISTES DES MEMOIRES </p>
        <a href="javascript:history.go(-1)">RETOUR</a>
    </div>
    <div class="image">
        <img src="image/lm.png">
    </div>
    <?php
        include 'connexion.php';

        $limit_per_page = 2; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1; 
        $offset = ($page - 1) * $limit_per_page;

        $sql = "SELECT id_memoire, titre, description, fichier, date_publication FROM memoires LIMIT :offset, :limit";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit_per_page, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            echo "<table border='1'>
            <tr>
                <th>ID Mémoire</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Fichier</th>
                <th>Date de Publication</th>
            </tr>";

            foreach ($result as $row) {
                echo "<tr>
                    <td>" . $row["id_memoire"] . "</td>
                    <td>" . $row["titre"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td><a href='" . $row["fichier"] . "'>Voir le fichier</a></td>
                    <td>" . $row["date_publication"] . "</td>
                </tr>";
            }

            echo "</table>";
            $next_page = $page + 1;
            $prev_page = $page - 1;

            echo "<div class='pagination'>";
            if ($page > 1) {
                echo "<a class='button' href='liste_memoire.php?page=$prev_page'>Précédent</a>";
            }

            $count_sql = "SELECT COUNT(*) as total FROM memoires";
            $stmt = $connect->query($count_sql);
            $row_count = $stmt->fetch(PDO::FETCH_ASSOC);
            $total_pages = ceil($row_count['total'] / $limit_per_page);

            if ($page < $total_pages) {
                echo "<a class='button' href='liste_memoire.php?page=$next_page'>Suivant</a>";
            }
            echo "</div>";
        }

    ?>
    <br><br><br><br><br><br>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>

</body>
</html>