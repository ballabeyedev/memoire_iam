<?php
// Connexion à la base de données
$servername = "mysql-balladev.alwaysdata.net";
$username = "balladev_iam";
$password = "devweb2024@";
$dbname = "balladev_iam";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer les valeurs envoyées par le formulaire
$id = $_POST['id'];
$newNom = $_POST['newNom'];
$newPrenom = $_POST['newPrenom'];
$newEmail = $_POST['newEmail'];

// Préparer la requête SQL de mise à jour
$sql = "UPDATE utilisateurs SET nom=?, prenom=?, email=? WHERE id=?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Erreur lors de la préparation : " . $conn->error);
}

// Lier les paramètres et exécuter la requête
$stmt->bind_param("sssi", $newNom, $newPrenom, $newEmail, $id);
if ($stmt->execute() === true) {
    echo "Enregistrement mis à jour avec succès";
} else {
    echo "Erreur lors de la mise à jour : " . $stmt->error;
}

// Fermer la déclaration et la connexion
$stmt->close();
$conn->close();
?>
