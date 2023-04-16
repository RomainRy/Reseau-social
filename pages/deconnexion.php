<?php
// Démarrez la session
session_start();

// Détruisez toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également les cookies de session
// Notez que cela détruira la session et pas seulement les données de la session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header('Location: connexion.php');
exit();
?>