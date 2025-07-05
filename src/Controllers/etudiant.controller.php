//etudiant.controller.php


<?php




require_once __DIR__ . '/../../autoload.php';
session_start(); 


use src\Repository\ClasseRepository;
use src\Repository\ProfesseurRepository;
use \src\Repository\ModuleRepository;
use src\Services\AuthService;


$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? null;

switch ($page) {
   
    case 'faire_demande':
    \src\Services\EtudiantService::faireDemande();
    break;

    case 'mes_demandes':
    \src\Services\EtudiantService::mesDemandes();
    break;

 


    
   




        





        


    default:
        
        break;
}

$routes = [
    'dashboard' => __DIR__ . '/../Views/layout/dashboard.html.php',
   

   
    'faire_demande' => __DIR__ .'/../Views/Etudiant/faire_demande.html.php',
    'mes_demandes' => __DIR__ .'/../Views/Etudiant/mesDemandes.html.php',
   


    'login' => __DIR__ . '/../Views/auth/login.html.php',









    // autres routes...
];



if (array_key_exists($page, $routes) && $page !== "login") {
    $content = $routes[$page];
     include_once __DIR__ . '/../Views/layout/layout.html.php';

} else{
      include_once __DIR__ . '/../Views/error/404.html.php';

   
}




