<?php
session_start();
require_once('connexion.php');

$login = "";

if (isset($_POST['Email']) && isset($_POST["passwd"])) {
    $login = $_POST['Email'];
    $password = $_POST['passwd'];

    try {
        $sql = "SELECT * FROM utilisateurs WHERE email = ? AND mot_de_passe = ?";
        $query = $connect->prepare($sql);
        $query->execute([$login, $password]);
        $user = $query->fetch();

        if ($user) {
            $_SESSION['Email'] = $login;
            if ($user['type_utilisateur'] === "admin") {
                header("Location: admin.php");
                exit();
            } elseif ($user['type_utilisateur'] === "etudiant") {
                header("Location: etudiant.php");
                exit();
            }
        } else {
            $error = "Cet utilisateur n'existe pas ou le mot de passe est incorrect.";
        }
    } catch (PDOException $e) {
        $error = "Erreur de base de données: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        .error-message {
            color: red;
            margin-top: 5px;
        }
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 1s ease-in-out;
        }

        .slide1 {
            background-image: url('image/font1.png');
        }

        .slide2 {
            background-image: url('image/font2.png');
        }

        .slide3 {
            background-image: url('image/font3.png');
        }
        .slide4 {
            background-image: url('image/font4.png');
        }

        .slide5 {
            background-image: url('image/font5.png');
        }

        .logo img{
            height: 100px;
        }
        .titre{
            margin-left: 450px;
            margin-top: -80px;
        }
        .Titre .t1{
            margin-left: 10px;
        }
        .login{
            margin-left: 400px
        }


    </style>
    <title>Page Connexion</title>
</head>
<body class="initial-slide">
    <div class="login">
        <form action="" method="post" id="myForm" onsubmit="return validateForm()">
            <div class="Titre">
                <p class="t1">Bienvenue sur La page Memoire IAM 2023-2024</p>
            </div><br>
            <div class="Email">
                <input type="text" name="Email" id="email" placeholder="Email et Telephone" value="<?= $login ?>" required>
            </div>
            <div class="Passwd">
                <input type="password" name="passwd" id="passwd" placeholder="Password" required>
            </div>
            <div class="error-message" id="error-message"></div>
            <div>
                <button class="button" type="submit" name="button" id="envoyer">Connexion</button>
                <div class="inscription"><a href="inscription.php">Créer un compte !</a></div>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('myForm');
        const email = document.getElementById('email');
        const passwd = document.getElementById('passwd');
        const errorsDiv = document.getElementById('error-message');
        const button = document.getElementById('envoyer');

        form.addEventListener('input', validateForm);

        function resetForm() {
        form.reset();
        }

        function validateForm() {
            errorsDiv.innerHTML = '';
            let hasErrors = false;

            if (email.value === '') {
                displayError('Le champ email est obligatoire.');
                hasErrors = true;
            }

            if (passwd.value === '') {
                displayError('Le champ mots de passe est obligatoire.');
                hasErrors = true;
            }
            button.disabled = hasErrors;
        }

        function displayError(errorMessage) {
            const errorPara = document.createElement('p');
            errorPara.classList.add('error');
            errorPara.textContent = errorMessage;
            errorsDiv.appendChild(errorPara);
        }
</script>
<script src="script.js"></script>

</body>
</html>

