<?php 

require_once 'database.php';

session_start();

// Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
  // Rediriger l'utilisateur vers la page d'accueil
  
} else {
  header('Location: connexion.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/publication.css">
  <title>Publication</title>
</head>

<body class="body">
  <div class="publication">
  <div class="background">
    <h2>Ajoutez une publication</h2>
    <form action="ajout.php" method="POST">
      <input type="hidden" name="form" value="formulaire_ajout_article">
      <label for="titre">Titre :</label>
      <input type="text" name="titre" id="titre">
      <br>
      <label for="contenu">Contenu :</label>
      <br>
      <textarea name="contenu" id="contenu" cols="30" rows="10"></textarea>
      <br>
      <input type="submit" value="Envoyer">
    </form>
  </div>
</body>

    