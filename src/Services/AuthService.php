<?php
namespace src\Services;

use src\Repository\UtilisateurRepository;
use src\Repository\EtudiantRepository;

class AuthService {
    public static function login(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_connexion'])) {
            $login = $_POST['login'];
            $motDePasse = $_POST['mot_de_passe'];

            $repo = new UtilisateurRepository();
            $user = $repo->findByLogin($login);

            if (!$user) {
                $etudiantRepo = new EtudiantRepository();
                $user = $etudiantRepo->findByLogin($login);
            }

            if ($user && password_verify($motDePasse, $user->getMotDePasse())) {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user->getRole()->value;



                header("Location: /gestionScolairePHP/public/index.php?controller=" . strtolower($_SESSION['role']) . "&page=dashboard");

                exit;
            }

            $_SESSION['error'] = "Login ou mot de passe invalide.";
            header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
            exit;
        }

        require_once __DIR__ . '/../Views/auth/login.html.php';

    }

    public static function logout(): void {
        session_start();
        session_destroy();
        header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
        exit;
    }
}

