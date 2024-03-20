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
        table {border-collapse: collapse; width: 50%; margin-left: 530px; margin-top: -260px;}
        th, td {border: 1px solid #ddd; padding: 8px; text-align: left;}
        th {background-color: #922B21;}
        .profils img {height: 20px; border: 2px solid black; border-radius: 30px; margin-top: 4px;}
        .profils {margin-left: 990px;}
        .edit-mode input {width: 100%;}
        .logo{margin-top: -120px; margin-left: -30px; height:620px;}
        .image1{margin-top: 80px; margin-left: 250px;}
        .titre h3{margin-top: -550px; margin-left: 500px; text-decoration: underline;}
        footer h3{color: #8B0000; margin-left: 500px; text-decoration: underline; margin-top: 20px;}
        footer{margin-top: 10px; margin-left: 100px;}
        .b1, .b2, .b3, .b4, .b5, .b6 {height:10px; background-color: black;}
        .b1, .b2, .b3 {margin-right: 700px; margin-left: 310px;}
        .b4, .b5, .b6 {margin-right: 100px; margin-left: 900px;}
        .barre1{margin-top: 70px;}
        .barre2{margin-top: -60px;}
        .titre a{margin-left: 500px;}
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
            <li><a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));"><button type="submit" class="disconnect">Déconnexion</button></a></li>
        </ul>
    </div>
    <div class="titre">
        <h3>MODIFICATION UTILISATEUR</h3>            
        <a href="javascript:history.go(-1)">RETOUR</a>
    </div>
    <div class="image1"><img src="image/mu.png" height="200px" alt=""></div>

    <?php
        $servername = "mysql-balladev.alwaysdata.net";
        $username = "balladev_iam";
        $password = "devweb2024@";
        $dbname = "balladev_iam";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        $sql = "SELECT id_utilisateur, nom, prenom, email FROM utilisateurs";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Actions</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
    <td>" . $row["id_utilisateur"]. "</td>
    <td>" . $row["nom"]. "</td>
    <td>" . $row["prenom"]. "</td>
    <td>" . $row["email"]. "</td>
    <td>
    <a href='modifier_user.php?id=" . $row['id_utilisateur'] . "'>Modifier</a>
    </td></tr>";

            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>

     <div class="barre1">
        <hr class="b1">
        <hr class="b2">
        <hr class="b3">
    </div>

    <div class="barre2">
        <hr class="b4">
        <hr class="b5">
        <hr class="b6">
    </div>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>
</body>
</html>
