<?php
require_once 'database.php';


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
        'contenu'=>$_POST['contenu']
      ];

      $request=$database->prepare("INSERT INTO articles(titre,contenu,date) VALUES (:titre,:contenu,NOW())");
      $request->execute($data);
      header("Location:index.template.php");
    }
  }
}