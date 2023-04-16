<?php

require 'database.php';

session_start();

// Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page d'accueil
    
} else {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Traitement de l'upload de l'avatar
    $avatar = $_FILES['avatar']['name'];
    $upload_dir = '../avatars/';
    $upload_file = $upload_dir . basename($avatar);
    $upload_ok = move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file);

    if (!$upload_ok) {
        die('Erreur lors de l\'upload de l\'avatar');
    }

    // Insertion des données dans la base de données
    $query = "INSERT INTO users (nom, pseudo, email, password, avatar) VALUES (:nom, :pseudo, :email, :password, :avatar)";
    $stmt = $database->prepare($query);
    $stmt->execute([
        'nom' => $nom,
        'pseudo' => $pseudo,
        'email' => $email,
        'password' => $password,
        'avatar' => $upload_file,
    ]);

    // Redirection vers la page de confirmation
    header("Location: ../index.php"); /* Redirection du navigateur */
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/inscription.css">
    
</head>
</head>

<body class="inscription">
    <div class="background">
        <h1>Inscription</h1>
        <form method="post" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom"><br><br>

        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo"><br><br>

        <label for="email">Email :</label>
        <input type="email" name="email"><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password"><br><br>

        <label for="avatar">Avatar :</label>
        <input type="file" name="avatar"><br><br>

        <input type="submit" value="S'inscrire">
        </form>
    </div>
    
</body>

</html>