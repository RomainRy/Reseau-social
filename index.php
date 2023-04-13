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
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
</head>
<body>
    <header class="navbar">
        <a href="#"  class="navbar-logo">Mini Post</a>
        <nav class="navbar-nav">
            <a href="#">Acueil</a>
            <a href="#">Profil</a>
            <a href="Inscription.php">Inscription</a>
            <a href="#">Paramètres</a>

        </nav>
    </header>
    <nav id="menu" class="container site">
        <ul class="sidebar">
            <li><a href="#" class="sidebar-home">Fil d'actualité</a></li>
            <li><a href="#" class="sidebar-messages">Messages</a></li>
            <li><a href="#" class="sidebar-events">Evènements</a></li>
            <li><a href="#" class="sidebar-amis">Amis</a></li>
            <li><a href="publication.php" class="sidebar-groupes">Publication</a></li>
        </ul>
    </nav>
        
    <div id="menu-burger">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
        
    

    <div class="container site">

        <main class="main">
            <article class="card">

                <header class="card-header card-header-avatar">   
                </header>

                <div class="card-body">
                    
                    <?php foreach ($articles as $article) :?>
                        <div class="publication">
                            <h3><?php echo $article['titre'] ?></h3>
                            <p><?php echo $article['contenu'] ?></p>
                            <p><?php echo "Ecrit à " . date("d/m/Y",strtotime($article['date'])) .
                            " à " . date("H:i", strtotime($article['date'])) ?></p>
                        
    
                              

                            <button class="toggle-panel"><img src="img/icons8-poubelle.svg" alt=""></button>  
                           
                            <div id="panel" class="panel" style="display:none;">
                            
                                <h2>Voulez-vous vraiment supprimer cette publication</h2>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="form" value="formulaire_supp_article">
                                    <input type="hidden" name="article_id" value="<?php echo $article['id']?>">
                                    <input type="submit" value="Supprimer">
                                </form>
                            </div>
                        </div>             
                    <?php endforeach;?>

                    <?php if (
                        !empty($titre) && !empty($contenu)
                    ) : ?>
                        
                        <h2>Article :</h2>
                        <?= "Titre : $titre" ?>
                        <?= "Contenu : $contenu" ?>
                    
                        
                    <?php endif; ?>
                </div>
            
            
            

            </article>
        </main>

        <aside class="aside">
            <article class="card">
                <header class="card-header card-header-avatar">
                    
                </header>     
                <div class="card-body"> 
                    
                </div>
            </article>
            <div class="sidebar-title">Publication</div>
            <div class="friends-list">
                <a href="publication.php" class="nouvelle">Nouvelle</a>
                <div class="friend"> 
                    
                    
                    <div class="friend-body">
                        
                    </div>
                    
                </div>
            </div>

            <div class="friends-list">
                <div class="friend"> 
                    
                    <div class="friend-body">
                        
                    </div>
                    
                </div>
            </div>

            <div class="friends-list">
                <div class="friend"> 
                    
                    <div class="friend-body">
                        
                    </div>  
                </div>
            </div>
        </aside>
    </div>
<script src="main.js"></script>
</body>
</html>