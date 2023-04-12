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
        <a href="#" class="navbar-logo">Logo</a>
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
    
                        <form action="delete.php" method="post">
                            <input type="hidden" name="form" value="formulaire_supp_article">
                            <input type="hidden" name="article_id" value="<?php echo $article['id']?>">
                            <input type="submit" value="Supprimer">
                        </div>    
                        </form>
                    
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
                    <img src="img/avatar.jpg" width="45" height="45" class="card-avatar" alt="">
                    <div class="card-title">Mon pseudo</div>
                    <div class="card-date">Inscrit il y a 10 ans</div>
                </header>     
                <div class="card-body"> 
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto nostrum perspiciatis facilis reiciendis pariatur voluptatum ipsa praesentium necessitatibus delectus eum veritatis nemo corporis atque corrupti expedita earum, consectetur non quam!
                    </p>
                </div>
            </article>
            <div class="sidebar-title">Suggestion</div>
            <div class="friends-list">
                <div class="friend"> 
                    <img class="friend-avatar" src="https://via.placeholder.com/73x73" alt="">
                    <div class="friend-body">
                        <a class="friend-name" href="#"> Maxime Dupuis</a>
                        <div class="friend-connections">15 amis mutuels</div>
                        <div class="friend-add" href="#" >Ajoutez en amis</div>
                    </div>
                    
                </div>
            </div>

            <div class="friends-list">
                <div class="friend"> 
                    <img class="friend-avatar" src="https://via.placeholder.com/73x73" alt="">
                    <div class="friend-body">
                        <a class="friend-name" href="#"> Jules Dupond</a>
                        <div class="friend-connections">11 amis mutuels</div>
                        <div class="friend-add" href="#" >Ajoutez en amis</div>
                    </div>
                    
                </div>
            </div>

            <div class="friends-list">
                <div class="friend"> 
                    <img class="friend-avatar" src="https://via.placeholder.com/73x73" alt="">
                    <div class="friend-body">
                        <a class="friend-name" href="#"> Walter White</a>
                        <div class="friend-connections">16 amis mutuels</div>
                        <div class="friend-add" href="#" >Ajoutez en amis</div>
                    </div>
                    
                </div>
            </div>

            <div>
                <img src="img/icons8-poubelle.svg" width="45" height="45" alt="">
                <input type="button" value="Supprimer cette publication" id="button1">
                <p></p>
            </div>

        </aside>
    </div>
<script src="main.js"></script>
</body>
</html>