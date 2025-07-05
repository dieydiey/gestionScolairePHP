<?php
require_once __DIR__ . '/../../autoload.php';
session_start(); 

use src\Repository\ClasseRepository;
use src\Repository\EtudiantRepository;


$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? null;

switch ($page) {
    case 'dashboard':
        // si tu as besoin de charger des données, fais-le ici
        break;

    case 'inscription':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'inscrire_etudiant') {
            \src\Services\InscriptionService::inscrire();
        }
        $classeRepo = new ClasseRepository();
        $classes = $classeRepo->findAll();
        break;

  case 'reinscription':
    if ($action === 'form' || is_null($action)) {
        $etudiantRepo = new EtudiantRepository();
        $classeRepo = new ClasseRepository();

        $etudiants = $etudiantRepo->findAll();
        $classes = $classeRepo->findAll();
    } elseif ($action === 'valider') {
        \src\Services\InscriptionService::valider();
    }
    break;


    case 'liste_etudiants':
        \src\Services\EtudiantService::listerEtudiants();
        break;

    default:
        break;
}

$routes = [
    'dashboard' => __DIR__ . '/../Views/layout/dashboard.html.php',
    'inscription' => __DIR__ . '/../Views/inscription_etudiant.html.php',
    'reinscription' => __DIR__ . '/../Views/reinscription_etudiant.html.php',
    'liste_etudiants' => __DIR__ . '/../Views/liste_etudiant.html.php',
];

if (array_key_exists($page, $routes)) {
    $content = $routes[$page];
    include_once __DIR__ . '/../Views/layout/layout.html.php';
} else {
    include_once __DIR__ . '/../Views/error/404.html.php';
}
