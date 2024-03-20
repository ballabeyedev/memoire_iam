<?php
include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = $_POST['Theme'];
    $domain = $_POST['Domaine'];

    error_log("Received Theme: " . $theme);
    error_log("Received Domaine: " . $domain);

    $insert_sql = "INSERT INTO memoires (Domaine, Theme) VALUES ('$domain', '$theme')";
    $insert_result = mysqli_query($conn, $insert_sql);

    if ($insert_result) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
