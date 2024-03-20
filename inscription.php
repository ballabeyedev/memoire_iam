<?php
    require_once("connexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['passwd'], $_POST['confirm_passwd'], $_POST['type_utilisateur'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $login = $_POST['login'];
            $passwd = $_POST['passwd'];
            $confirm_passwd = $_POST['confirm_passwd'];
            $type_utilisateur = $_POST['type_utilisateur'];

            if ($passwd !== $confirm_passwd) {
                $errorMessage = "Les mots de passe ne correspondent pas.";
            } else {
                $check_query = "SELECT * FROM utilisateurs WHERE email = :login";
                $stmt = $connect->prepare($check_query);
                $stmt->execute([':login' => $login]);
                if ($stmt->rowCount() > 0) {
                    $errorMessage = "Le login existe déjà. Veuillez choisir un autre login.";
                } else {
                    $query = $connect->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, type_utilisateur) VALUES (?, ?, ?, ?, ?)");
                    $testquery = $query->execute([$nom, $prenom, $login, $passwd, $type_utilisateur]);

                    if ($testquery) {
                        header("Location: index.php");
                        exit; 
                    } else {
                        $errorMessage = "Erreur lors de l'insertion";
                    }
                }
            }
        } else {
            $errorMessage = "Les données nécessaires ne sont pas définies";
        }
    }

    $query = $connect->query("SELECT * FROM utilisateurs");
    $list = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="inscription.css">
    <style>
        .toous{
            margin-top: -80px;
            margin-left: 250px;
        }
        .toous h3{
            text-decoration: underline;
            margin-left: 400px;

        }
        .header img{
            height: 100px;
            width: 200px;
        }
        .ins img{
            margin-left: 160px;
        }
        .unique {
        background-color: #ffcccc; 
        color: #cc0000;
        padding: 10px; 
        border: 1px solid #cc0000; 
        border-radius: 5px; 
        margin-bottom: 10px; 
        /* margin-top: 400px; */
        margin-left: 100px;
        margin-right: 300px; 
        width: 250px
    } 
    </style>
</head>
<body>
    <div class="header">
        <img src="image/logo2.png" alt="">
    </div>
    <div class="toous">
        <hr class="hr">
        <h3>S'INSCRIRE EN TANT QUE JOUEUR</h3>
        <div class="ins">
            <img src="image/font1.png" alt="">
        </div>
        <form class="login" method="post">
            <input type="text" name="nom" id="nom" placeholder="Nom" required>
            <br>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
            <br>
            <input type="text" name="login" id="login" placeholder="Adresse email" required>
            <br>
            <input type="password" name="passwd" id="passwd" placeholder="Mot de Passe" required>
            <br>
            <input type="password" name="confirm_passwd" id="confirm_passwd" placeholder="Confirmer le Mot de Passe" required>
            <br>
            <select name="type_utilisateur" id="type_utilisateur" required>
                <option value="">Sélectionnez le type d'utilisateur</option>
                <option value="etudiant">etudiant</option>
            </select>

            <br>
            <div id="error-message"></div>
            <button type="submit">S'Inscrire →</button>
            <?php if(isset($errorMessage) && !empty($errorMessage)): ?>
            <div class="unique"><?php echo $errorMessage; ?></div>
            <?php endif; ?> 
        </form>
    </div>
    <script>
        const form = document.querySelector('.login');
        const nom = document.getElementById('nom');
        const prenom = document.getElementById('prenom');
        const login = document.getElementById('login');
        const passwd = document.getElementById('passwd');
        const confirmPasswd = document.getElementById('confirm_passwd');
        const errorsDiv = document.getElementById('error-message');
        const button = document.getElementById('envoyer');

        form.addEventListener('input', validateForm);

        function resetForm() {
            form.reset();
        }
        function validateForm() {
            errorsDiv.innerHTML = '';
            let hasErrors = false;

            if (nom.value === '') {
                displayError('Le champ nom est obligatoire.');
                hasErrors = true;
            }

            if (prenom.value === '') {
                displayError('Le champ prénom est obligatoire.');
                hasErrors = true;
            }

            if (login.value === '') {
                displayError('Le champ login est obligatoire.');
                hasErrors = true;
            }

            if (passwd.value === '') {
                displayError('Le champ mot de passe est obligatoire.');
                hasErrors = true;
            }

            if (confirmPasswd.value === '') {
                displayError('Le champ de confirmation du mot de passe est obligatoire.');
                hasErrors = true;
            }

            if (passwd.value !== confirmPasswd.value) {
                displayError('Les mots de passe ne correspondent pas.');
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
</body>
</html>
