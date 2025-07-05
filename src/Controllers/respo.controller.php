//respo.controller.php


<?php




require_once __DIR__ . '/../../autoload.php';
session_start(); 


use src\Repository\ClasseRepository;
use src\Repository\ProfesseurRepository;
use \src\Repository\ModuleRepository;
use src\Service\AuthService;


$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? null;

switch ($page) {
    case 'classe':
        if ($action === 'add_classe') {
            \src\Services\ClasseService::addClass();
        } else {
            $repo = new \src\Repository\ClasseRepository();
            $classes = $repo->findAll();
        }
        break;
    case 'classe_formulaire':
    // pas besoin de data
    break;

    
    case 'module':
        if ($action === 'add_module' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            \src\Services\ModuleService::add();
        } else {
            $repo = new \src\Repository\ModuleRepository();
            $modules = $repo->findAll();
        }
        break;
    case 'module_formulaire':
    // pas besoin de data
    break;



    case 'professeur_formulaire':
    // pas besoin de data
    break;

    case 'professeur':
        if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            \src\Services\ProfesseurService::add();
        } else {
            $repo = new \src\Repository\ProfesseurRepository();
            $professeurs = $repo->findAll();
        }
        break;



    case 'professeur_classes':
        if (isset($_GET['id'])) {
            $repo = new ProfesseurRepository();
            $professeur = $repo->findById((int)$_GET['id']);
            if (!$professeur) {
                $_SESSION['error'] = "Professeur introuvable.";
                header('Location: /gestionScolairePHP/public/index.php?page=professeur');
                exit;
            }
        }
        break;

    case 'professeur_modules':
        if (isset($_GET['id'])) {
            $repo = new ProfesseurRepository();
            $professeur = $repo->findById((int)$_GET['id']);
            if (!$professeur) {
                $_SESSION['error'] = "Professeur introuvable.";
                header('Location: /gestionScolairePHP/public/index.php?page=professeur');
                exit;
            }
        }
        break;
    
    case 'affectation_classes':
        if ($action === 'affecter' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            \src\Services\ClasseService::affecterClasse();
        } else {
            $profRepo = new \src\Repository\ProfesseurRepository();
            $professeurs = $profRepo->findAll();

            $classeRepo = new \src\Repository\ClasseRepository();
            $classes = $classeRepo->findAll();
        }
        break;

    
    case 'affectation_modules':
        if ($action === 'affecter_modules' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            \src\Services\ModuleService::affecterModule();
        } else {
            $profRepo = new \src\Repository\ProfesseurRepository();
            $professeurs = $profRepo->findAll();

            $moduleRepo = new \src\Repository\ModuleRepository();
            $modules = $moduleRepo->findAll();
        }
        break;


    case 'professeurs_par_module':
        $moduleRepo = new ModuleRepository();
        $modules = $moduleRepo->findAll();

        if (isset($_GET['module_id'])) {
            $profRepo = new ProfesseurRepository();
            $professeurs = $profRepo->findProfesseursByModule((int)$_GET['module_id']);
        }
         break;
    
    
    case 'demande':
        if ($action === 'traiter') {
            \src\Services\DemandeService::traiterDemande();
        } else {
            \src\Services\DemandeService::listeDemandes();
        }
        break;



   
    
    case 'dashboard':
        $statRepo = new \src\Repository\StatistiqueRepository();
        $effectifParAnnee = $statRepo->effectifParAnnee();
        $filleGarconParAnnee = $statRepo->repartitionSexeParAnnee();
        $effectifParClasse = $statRepo->effectifParClasse();
        $filleGarconParClasse = $statRepo->repartitionSexeParClasse();
        $suspensionAnnulationParAnnee = $statRepo->demandesParAnnee();
        
    break;




        





        


    default:
        
        break;
}

$routes = [
    'dashboard' => __DIR__ . '/../Views/statistiques.html.php',
    'classe' => __DIR__ . '/../Views/RP/Classes/liste.html.php',
    'classe_formulaire' => __DIR__ . '/../Views/RP/Classes/form.html.php',
    'module' => __DIR__ . '/../Views/RP/Modules/liste.html.php',
    'module_formulaire' => __DIR__ . '/../Views/RP/Modules/form.html.php',
    'professeur' => __DIR__ . '/../Views/RP/Professeur/liste.html.php',
    'professeur_formulaire' => __DIR__ . '/../Views/RP/Professeur/form.html.php',
    'professeur_classes' => __DIR__ . '/../Views/RP/Professeur/professeur_classes.html.php',
    'professeur_modules' => __DIR__ . '/../Views/RP/Professeur/professeur_modules.html.php',
    'affectation_classes' => __DIR__ . '/../Views/RP/Classes/affectation_classes.html.php',
    'affectation_modules' => __DIR__ . '/../Views/RP/Modules/affectation_modules.html.php',
    'professeurs_par_module' => __DIR__ . '/../Views/professeurs_par_module.html.php',
    
    
    'demande' => __DIR__ .'/../Views/RP/traiter_demande.html.php',
    'statistiques' => __DIR__ . '/../Views/statistiques.html.php',


    









    // autres routes...
];



if (array_key_exists($page, $routes) && $page !== "login") {
    $content = $routes[$page];
     include_once __DIR__ . '/../Views/layout/layout.html.php';

} else{
      include_once __DIR__ . '/../Views/error/404.html.php';

   
}




