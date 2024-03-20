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
            margin-top: -230px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .profils img {
            height: 20px;
            border: 2px solid black;
            border-radius: 30px;
            margin-top: 4px;
        }

        .profils {
            margin-left: 1000px;
        }

        .delete-button {
            background-color: #e74c3c;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .logo{
            margin-top: -120px;
            height:620px;
            margin-left: -30px;
        }
        .img{
            margin-top: 90px;
            margin-left: 300px;
        }
        .titre{
            margin-top: -550px;
            margin-left: 470px;
        }
        .titre h3{
            text-decoration: underline;
        }
        footer h3{
            color: #8B0000;
            margin-left: 500px;
            text-decoration: underline;
            margin-top: 20px;
        }
        footer{
            margin-top: 100px;
            margin-left: 100px;
        }
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
        <img src="image/logo2.png" alt="Logo Image">
        <ul>
            <li><a href="admin.php">Menu</a></li>
            <li><a href="parametre.php">Paramètres</a></li>
            <li><a href="profils.php">Profil</a></li>
            <li>
                <a href="index.php" onclick="return(confirm('Vous vous déconnectez ?'));">
                    <button type="submit" class="delete-button">Déconnexion</button>
                </a>
            </li>
        </ul>
    </div>
    <div class="titre">
        <h3>MODIFICATION UTILISATEUR</h3>            
        <a href="javascript:history.go(-1)">RETOUR</a>
    </div>
    <div class="img">
        <img src="image/su.png" alt="" height="200px">
    </div>

    <?php
    $servername = "mysql-balladev.alwaysdata.net";
    $username = "balladev_iam";
    $password = "devweb2024@";
    $dbname = "balladev_iam";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    if (isset($_POST['nom'])) {
        $nom = $_POST['nom'];
        $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE nom = ?");
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $stmt->close();
        echo "Suppression réussie";
    } else {
        echo "";
    }

    $sql = "SELECT nom, prenom, email, mot_de_passe, type_utilisateur FROM utilisateurs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Mot de passe</th><th>Type utilisateur</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nom"] . "</td><td>" . $row["prenom"] . "</td><td>" . $row["email"] . "</td><td>" . $row["mot_de_passe"] . "</td><td>" . $row["type_utilisateur"] . "</td><td>
                <button onclick='supprimerUtilisateur(\"" . $row['nom'] . "\")' class='delete-button'>Supprimer</button>
                </td></tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun résultat trouvé.";
    }

    $conn->close();
    ?>

    <script>
        function supprimerUtilisateur(nom) {
            if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                    }
                };
                xhttp.open("POST", "delete_user.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("nom=" + encodeURIComponent(nom));
            }
        }
    </script>
    <footer>
        <h3>IAM 2023-2024 MEMOIRE </h3>
    </footer>

</body>
</html>
