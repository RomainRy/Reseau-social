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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if (
    isset($_POST['form'])
    && $_POST['form'] === "formulaire_ajout_article"
  ) {
    if (
      !empty($_POST['titre']) && !empty($_POST['contenu'])
    ) {
      $data=[
        'titre'=>$_POST['titre'],
        'contenu'=>$_POST['contenu'],
        'pseudo'=>$_SESSION['pseudo']
      ];

      $request=$database->prepare("INSERT INTO articles(titre,contenu,pseudo,date) VALUES (:titre,:contenu,:pseudo,NOW())");
      $request->execute($data);
      header("Location: ../index.php");
    }
  }
}