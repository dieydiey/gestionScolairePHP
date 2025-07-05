<?php
namespace src\Services;

require_once __DIR__ . '/../../autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


use src\Models\Demande;
use src\Repository\DemandeRepository;
use src\Enum\Role;
use src\Enum\TypeDemande;
use src\Enum\EtatDemande;



class DemandeService
{
    

   

  

   


    public static function traiterDemande(): void
{

        
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::RP) {
            $_SESSION['error'] = "Accès interdit.";
            header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $demandeId = $_POST['demande_id'] ?? null;
            $action = $_POST['action'] ?? null;

            if (!$demandeId || !in_array($action, ['acceptée', 'refusée'])) {
                $_SESSION['error'] = "Action invalide.";
                header("Location: /gestionScolairePHP/public/index.php?controller=RP&page=traiter_demandes");
                exit;
            }

            $etat = $action === 'acceptée' ? EtatDemande::ACCEPTEE : EtatDemande::REFUSEE;

            $repo = new DemandeRepository();
            $repo->updateEtat((int)$demandeId, $etat, $_SESSION['user']->getId());

            $_SESSION['success'] = "Demande traitée avec succès.";
            header("Location: /gestionScolairePHP/public/index.php?controller=RP&page=demande");
            exit;
        }
    }

    public static function listeDemandes(): void
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::RP) {
            header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
            exit;
        }

        $repo = new DemandeRepository();
        $demandes = $repo->findAll();

        require_once __DIR__ . '/../Views/RP/traiter_demande.html.php';
    }


    


}
