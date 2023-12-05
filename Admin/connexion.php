<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion</title>

    <!-- Inclure le CDN de Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa; /* Couleur de fond de la page */
			background-image: url("../images/img3");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
      
        
        }

        .box {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            background-color: #ffffff; /* Couleur de fond de la boîte */
            border: 1px solid #dee2e6; /* Bordure de la boîte */
            border-radius: 8px; /* Coins arrondis de la boîte */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre de la boîte */
        }

        .box-title {
            text-align: center;
            color: #007bff; /* Couleur du titre */
        }

        .box-input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da; /* Bordure des champs de saisie */
            border-radius: 4px;
        }

        .box-button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff; /* Couleur du bouton */
            color: #ffffff; /* Couleur du texte du bouton */
            border-radius: 4px;
            cursor: pointer;
        }

        .box-button:hover {
            background-color: #0056b3; /* Couleur du bouton au survol */
        }

        .box-register {
            text-align: center;
            margin-top: 10px;
        }

        .errorMessage {
            color: #dc3545; /* Couleur du message d'erreur */
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
require('config.php');
session_start();

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: ../accueil.php");
	}else{
		$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
	}
}
?>
<div class="container">
    <form class="box" action="" method="post" name="login">
        <h1 class="box-logo box-title"></h1>
        <h1 class="box-title">Connexion</h1>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion" name="submit" class="box-button">
        <p class="box-register">Vous êtes nouveau ici? <a href="inscription.php">S'inscrire</a></p>
        <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
    </form>
</div>

<!-- Inclure Bootstrap JS (facultatif, mais nécessaire pour certaines fonctionnalités) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
