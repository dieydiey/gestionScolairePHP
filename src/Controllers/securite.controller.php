<?php

require_once __DIR__ . '/../../autoload.php';
session_start();

use src\Services\AuthService;

// Récupération de la page demandée
$page = $_GET["page"] ?? 'login';

// Traitement des routes
if ($page === 'login') {
    // Appel de la méthode de login
    AuthService::login();

    // Affiche uniquement la page login sans inclure le layout (évite boucle de redirection)
   require_once __DIR__ . '/../Views/auth/login.html.php';

    exit;
} elseif ($page === 'logout') {
    AuthService::logout();
    exit;
} else {
    // Page inconnue = erreur 404
    include_once __DIR__ . '/../Views/error/404.html.php';
    exit;
}
