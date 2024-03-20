<?php
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: index.php");
    exit();
}

require 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_utilisateur = $_POST['id_utilisateur'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE id_utilisateur = ?";
    $stmt = $connect->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $id_utilisateur]);

    header("Location: modif_user.php?modification=success");
} else {
    echo "Méthode non autorisée.";
}
?>
