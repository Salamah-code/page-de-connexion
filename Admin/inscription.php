<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscription</title>

    <!-- Inclure le CDN de Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <!-- Inclure votre propre fichier de style CSS après Bootstrap si nécessaire -->
    <link rel="stylesheet" href="style.css" />

</head>
<style>
	body{
		background-image: url("../images/img3");
		background-repeat: repeat;
		background-attachment: fixed;
     
	}
</style>
<body class="bg-success">
    <?php
    require('config.php');
    if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username); 

        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "INSERT into `admin` (username, email, password)
                  VALUES ('$username', '$email', '".hash('sha256', $password)."')";

        $res = mysqli_query($conn, $query);
        if($res){
            echo "<div class='container mt-5'>
                    <div class='alert alert-success text-center' role='alert'>
                        <h3 class='text-success'>Vous êtes inscrit avec succès.</h3>
                        <p>Cliquez ici pour vous <a href='connexion.php' class='text-success'>connecter</a></p>
                    </div>
                </div>";
        }
    } else {
    ?>
    <div class="container mt-5">
        <form class="row g-3 needs-validation" action="" method="post" novalidate>
            <h1 class="box-logo box-title col-md-12 text-center"></h1>
            <h1 class="box-title col-md-12 text-center">S'inscrire</h1>
            <div class="col-md-4 offset-md-4">
                <label for="validationCustom01" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="validationCustom01" name="username" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="col-md-4 offset-md-4">
                <label for="validationCustom02" class="form-label">Email</label>
                <input type="email" class="form-control" id="validationCustom02" name="email" placeholder="Email" required>
            </div>
            <div class="col-md-4 offset-md-4">
                <label for="validationCustom03" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="validationCustom03" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="submit" name="submit">S'inscrire</button>
            </div>
            <div class="col-md-12 text-center">
                <p class="box-register">Déjà inscrit? <a href="connexion.php" class="text-success">Connectez-vous ici</a></p>
            </div>
        </form>
    </div>
    <?php } ?>

    <!-- Inclure Bootstrap JS (facultatif, mais nécessaire pour certaines fonctionnalités) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Activer la validation de formulaire Bootstrap -->
    <script>
        (function () {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>
