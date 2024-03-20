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
    echo "Paramètre manquant.";
}

$conn->close();
?>
