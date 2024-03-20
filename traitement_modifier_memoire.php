<?php
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: index.php");
    exit();
}

include 'connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_memoire = $_POST['id_memoire'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_publication = $_POST['date_publication'];
    $fichier = $_POST['fichier'];

    $sql = "UPDATE memoires SET titre = :titre, description = :description, date_publication = :date_publication, fichier = :fichier WHERE id_memoire = :id_memoire";

    $stmt = $connect->prepare($sql);
    $stmt->execute([
        ':titre' => $titre,
        ':description' => $description,
        ':date_publication' => $date_publication,
        ':id_memoire' => $id_memoire,
        ':fichier' => $fichier
    ]);

    header("Location: modifier.php?modification=success");
} else {
    echo "Méthode non autorisée.";
}
?>
