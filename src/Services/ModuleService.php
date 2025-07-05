<?php
namespace src\Services;

require_once __DIR__ . '/../../autoload.php';

use src\Enum\Role;

use src\Repository\ModuleRepository;
use src\Repository\ProfesseurRepository;



class ModuleService{
    public static function add(){
        if (isset($_POST['add_module'])) {
            $libelle = trim($_POST['libelle'] ?? '');
            $code = trim($_POST['code'] ?? '');

            if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::RP) 
            {
                $_SESSION['error'] = "Accès non autorisé.";
                header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
                exit;
            }

            if (empty($libelle) || empty($code)) {
                $_SESSION['error'] = "Tous les champs sont obligatoires.";
            } else {
                $repo = new ModuleRepository();

                if ($repo->exists('libelle', $libelle)) {
                    $_SESSION['error'] = "Un module avec ce libellé existe déjà.";
                } elseif ($repo->exists('code', $code)) {
                    $_SESSION['error'] = "Un module avec ce code existe déjà.";
                } else {
                    $repo->add($libelle, $code);
                    $_SESSION['success'] = "Module ajouté avec succès.";
                }
            }

            header('Location: /gestionScolairePHP/public/index.php?controller=RP&page=module_formulaire');
            exit;
        }

    }

    public static function affecterModule(): void{
        if (isset($_POST['affecter_modules'])) {
            $profId = $_POST['professeur_id'] ?? null;
            $modules = $_POST['modules'] ?? [];

             if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::RP) 
            {
                $_SESSION['error'] = "Accès non autorisé.";
                header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
                exit;
            }

            if (!$profId || empty($modules)) {
                $_SESSION['error'] = "Veuillez choisir un professeur et au moins un module.";
            } else {
                $repo = new ProfesseurRepository();
                foreach ($modules as $idModule) {
                    $repo->affecterModule((int)$profId, (int)$idModule);
                }
                $_SESSION['success'] = "Modules affectés avec succès.";
            }

            header('Location: /gestionScolairePHP/public/index.php?controller=RP&page=affectation_modules');
            exit;
        }
    }

}


