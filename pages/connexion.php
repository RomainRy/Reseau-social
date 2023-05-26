<?php

require_once 'database.php';

session_start();

// Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['pseudo'])) {
    // Rediriger l'utilisateur vers la page d'accueil
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifiez que l'utilisateur a soumis un nom d'utilisateur et un mot de passe
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $dsn = 'mysql:host=' . $host . ';dbname=blog';
        $pdo = new PDO($dsn, $user, $pass);

        // Préparez la requête pour vérifier si l'utilisateur existe et si le mot de passe est correct
        $query = "SELECT * FROM users WHERE email=:username AND password=:password";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->execute();

        if ($statement->rowCount() == 1) {
            // L'utilisateur est authentifié, stockez le nom d'utilisateur dans la session
            $_SESSION['username'] = $username;

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $pseudo = $row['pseudo'];
            $avatar = $row['avatar'];
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['avatar'] = $avatar;

            // Rediriger l'utilisateur vers la page d'accueil
            header('Location: ../index.php');

            exit();
        } else {
            // Affichez un message d'erreur si le nom d'utilisateur ou le mot de passe est incorrect
            $errorMessage = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }

        // Fermez la connexion à la base de données
        $pdo = null;
    } else {
        // Affichez un message d'erreur si le nom d'utilisateur ou le mot de passe est manquant
        $errorMessage = 'Veuillez entrer un nom d\'utilisateur et un mot de passe.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/connection.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Publication</title>
</head>


<body class="connection">
    <div class="background">
        <div class="col-lg-12 text-center">
            <h1 class="gras">Connexion</h1><br>

            <?php if (isset($errorMessage)): ?>
                <p>
                    <?php echo $errorMessage; ?>
                </p>
            <?php endif; ?>

            <form method="post" action="connexion.php">
                <div class="row mb-3 align-items-center">
                    
                    <div class="col-sm-12">
                        <input type="email" name="username" required class="form-control" placeholder="Email" required>
                    </div>
                </div>
        
                <br>

                <div class="row mb-3 align-items-center">
                    
                    <div class="col-sm-12">
                        <input type="password" name="password" required class="form-control" placeholder="Mot de passe" required>
                    </div>    
                </div>

                <br>
                <button type="submit" class="btn btn-light">Connexion</button>
                <a class="btn btn-light" href="inscription.php">Inscription</a>
                
            </form>
        </div>
        
    </div>
</body>

</html>