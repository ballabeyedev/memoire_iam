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
    <title>Liste des Joueurs</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-left: 550px;
            margin-top: -300px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4682B4;
        }

        .profils img {
            height: 20px;
            border: 2px solid black;
            border-radius: 30px;
            margin-top: 4px;
        }

        .profil {
            margin-left: 990px;
            margin-top: -60px;
        }
        .logo{
            margin-top: -120px;
            margin-left: -40px;
            height:660px;
        }
        .img{
            margin-top: -500px;
            margin-left: 250px;
        }
        .img img{
            border: 2px solid black;
            border-radius: 30px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-left: 600px; 
        }

        .pagination a {
            padding: 8px 5px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: black;
        }
        .div{
            margin-left: 300px;
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
    </style>
</head>
<body>
    <div class="retour">
        <a href="javascript:history.go(-1)">RETOUR</a>
    </div>
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
    <div class="img">
        <img src="image/sm.png" height="250px">
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_memoire'])) {
            supprimerMemoire($_POST['id_memoire']);
        }

        function supprimerMemoire($id) {
            $servername = "mysql-balladev.alwaysdata.net";
            $username = "balladev_iam";
            $password = "devweb2024@";
            $dbname = "balladev_iam";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }

            $sql = "DELETE FROM memoires WHERE id_memoire = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }

            $servername = "mysql-balladev.alwaysdata.net";
            $username = "balladev_iam";
            $password = "devweb2024@";
            $dbname = "balladev_iam";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        $itemsPerPage = 2;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $itemsPerPage;

        $sql = "SELECT id_memoire, titre, description, date_publication FROM memoires LIMIT $offset, $itemsPerPage";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Titre</th><th>Description</th><th>Date de Publication</th><th>Actions</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["titre"]."</td><td>".$row["description"]."</td><td>".$row["date_publication"]."</td><td>
                <form method='post'>
                    <input type='hidden' name='id_memoire' value='".$row['id_memoire']."'>
                    <button type='submit'>Supprimer</button>
                </form>
                </td></tr>";
            }
            echo "</table>";

            $totalItems = $conn->query("SELECT COUNT(*) AS total FROM memoires")->fetch_assoc()['total'];
            $totalPages = ceil($totalItems / $itemsPerPage);
            echo"<div class='div'>";
            echo "<div class='pagination' style='margin-left: 300px;'>";
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='?page=$i'>$i</a> ";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "Aucun résultat trouvé.";
        }
        $conn->close();
    ?>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>
