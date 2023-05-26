<?php

require_once 'pages/database.php';

session_start();

// Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['pseudo'])) {
    // Rediriger l'utilisateur vers la page d'accueil

} else {
    header('Location: pages/connexion.php');
    exit();
}

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
            $tag = $_POST['tag'];
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/anim.css">
    <link rel="stylesheet" href="css/popup.css">
</head>

<body>
    <header class="navbar">
        <a href="#" class="navbar-logo" style="display: flex;align-items: center;">
            <p>Bienvenue
                <?php echo $_SESSION['pseudo'] ?>
            </p>
            <img style="margin-left:20px;" src="<?php echo $_SESSION['avatar'] ?>" width="40px">
        </a>

        <nav class="navbar-nav">
            <a href="#">Acueil</a>
            <a href="#">Profil</a>
            <a href="pages/inscription.php">Inscription</a>
            <a href="#">Paramètres</a>
            <a href="pages/connexion.php">Connexion</a>
            <a href="pages/deconnexion.php">Déconnexion</a>

        </nav>
    </header>
    <nav id="menu" class="container site">
        <ul class="sidebar">
            <li><a href="#" class="sidebar-home">Fil d'actualité</a></li>
            <li><a href="#" class="sidebar-messages">Messages</a></li>
            <li><a href="#" class="sidebar-events">Evènements</a></li>
            <li><a href="#" class="sidebar-amis">Amis</a></li>
            <li><a href="pages/publication.php" class="sidebar-groupes">Publication</a></li>
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

                <div id="filters">
                    <button class="filter-button active" data-filter="all">Tous</button>
                    <button class="filter-button" data-filter="Sport">Sport</button>
                    <button class="filter-button" data-filter="Informatique">Informatique</button>
                    <button class="filter-button" data-filter="Environnement">Environnement</button>
                </div>

                <div id="articles" class="card-body">

                    <?php foreach ($articles as $article): ?>
                        <div class="article" data-tags="<?php echo $article['tag'] ?>">
                            <div class="publication">
                                <div class="left">
                                    <?php echo $article['pseudo'] ?>
                                </div>

                                <h3>
                                    <?php echo $article['titre'] ?>
                                </h3>
                                <p>
                                    <?php echo $article['contenu'] ?>
                                </p>
                                <p>
                                    <?php echo "Ecrit à " . date("d/m/Y", strtotime($article['date'])) .
                                        " à " . date("H:i", strtotime($article['date'])) . " <br>Tag : " . $article['tag'] ?>
                                </p>




                                <button class="toggle-panel"><img src="img/icons8-poubelle.svg" alt=""></button>

                                <div id="panel" class="panel" style="display:none;">

                                    <h2>Voulez-vous vraiment supprimer cette publication</h2>
                                    <form action="pages/delete.php" method="post">
                                        <input type="hidden" name="form" value="formulaire_supp_article">
                                        <input type="hidden" name="article_id" value="<?php echo $article['id'] ?>">
                                        <input type="submit" value="Supprimer">
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <?php if (
                        !empty($titre) && !empty($contenu)
                    ): ?>

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
                <!-- <a href="pages/publication.php" class="nouvelle">Nouvelle</a>
                <div class="friend"> -->

                <button id="openModalBtn">Publier un post</button>

                <div id="modal" class="modal">
                    <div class="modal-content">
                        <span class="close" style="padding-left:80%" ;>&times;</span>
                        <h2>Formulaire de publication de post</h2>
                        <form id="postForm" action="pages/ajout.php" method="POST">

                            <select id="tagSelect" name="tag">
                                <option value="Sport">Sport</option>
                                <option value="Informatique">Informatique</option>
                                <option value="Environnement">Environnement</option>
                            </select>
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
                </div>
            </div>

            <br><br><br>

            <h2 style="color:black;">Rechercher un Tweet</h2>
            <form action="" method="GET">
                <label for="recherche" style="color:black;">recherche :</label>
                <br>
                <input type="text" name="recherche" id="recherche">
                <br>
            </form>



            <div class="friend">



                <div class="friend-body">

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
    <script src="js/main.js"></script>
</body>

</html>