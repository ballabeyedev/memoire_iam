<?php
if(isset($_GET['file'])) {
    $file = '' . urldecode($_GET['file']);

    if(file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo "Le fichier n'existe pas.";
    }
} else {
    echo "Paramètre de fichier manquant.";
}
?>
