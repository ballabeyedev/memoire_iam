<?php
$servername = "mysql-balladev.alwaysdata.net";
$username = "balladev_iam";
$password = "devweb2024@";
$dbname = "balladev_iam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if (isset($_GET['titre'])) {
    $titre = $_GET['titre'];
    $sql = "DELETE FROM memoires WHERE titre = '$titre'";

    if ($conn->query($sql) === TRUE) {
        echo "Suppression réussie";
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
} else {
    echo "Paramètre manquant.";
}

$conn->close();
?>
