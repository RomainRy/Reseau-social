<?php 

require_once 'database.php';
ini_set("date.timezone", "Europe/Paris");

// RANGER DANS ORDRE CHRONOLOGIQUE
$request = $database->prepare("SELECT * FROM articles ORDER BY date DESC"); 
// FIN
$request->execute();
$articles = $request->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "GET") {

  if (
    !empty($_GET['recherche'])
    ) {
      $data = [
        "recherche" => "%" . $_GET['recherche'] . "%"
      ];
      
      $request = $database->prepare("SELECT * FROM articles WHERE titre LIKE :recherche ORDER BY date DESC");
      $request->execute($data);
      $articles = $request->fetchAll(PDO::FETCH_ASSOC);
      
    }
  }

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if (
    isset($_POST['form'])
    && $_POST['form'] === "formulaire_ajout_article"
  ) {
    if (
      !empty($_POST['titre']) && !empty($_POST['contenu'])
    ) {
      $titre = $_POST['titre'];
      $contenu = $_POST['contenu'];
    }
  }
}
  
require 'index.php';
?>