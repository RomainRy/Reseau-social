<?php

require 'database.php';

session_start();

/* // Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page d'accueil
    
} else {
    header('Location: connexion.php');
    exit();
} */

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

    session_unset();
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['avatar'] = $upload_file;

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
</head>
</head>

<body class="inscription">
    <div class="background">
        <div class="col-lg-12 text-center">
        
            <h1 class="gras">Inscription</h1><br>
            <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="avatar" class="col-sm-12 col-form-label">Votre avatar :</label>
                    <div class="col-sm-12">
                        <input type="file" name="avatar" class="form-control" placeholder="Avatar" required>
                    </div> 
                </div>
                    
                    <input type="submit" value="S'inscrire" class="btn btn-light">
            </form>
            
        </div>
    </div>
    
</body>

</html>