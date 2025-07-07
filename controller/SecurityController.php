<?php


namespace App\Controller;

use App\Config\Core\AbstractController;
use App\Config\Core\Validator;
use App\Service\SecurityService;



class SecurityController extends AbstractController

{

    private SecurityService $securityService;
    private Validator $validator;

    public function __construct()
    {
        parent::__construct(); // IMPORTANT pour initialiser $this->session
        $this->securityService = new SecurityService();
        $this->layout = 'security.base.layout.php';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return header('Location: /login');
        }

        $login = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($login) || empty($password)) {
            return $this->renderHtml('security/login.html.php', [
                'title' => 'Connexion',
                'error' => 'Veuillez remplir tous les champs.',
            ]);
        }

        $vendeur = $this->securityService->seConnecter($login, $password);

        if ($vendeur) {
            $this->session->set('user_logged', true);
            $this->session->set('user', $vendeur);

            return header('Location: /list');
        } else {
            return $this->renderHtml('security/login.html.php', [
                'title' => 'Connexion',
                'error' => 'Identifiants incorrects.',
            ]);
        }
    }



















































































    // public function __construct()
    // {
    //     $this->layout = 'security.base.layout.php'; // Utiliser un layout spécifique pour la sécurité
    // }

    public function index()
    {
        $this->renderHtml('security/login.html.php', [
            'title' => 'Connexion - Le Ndanan du code'
        ]);
    }

    // public function login()
    // {
    //     // Afficher le formulaire de connexion
    //     $this->renderHtml('security/login.html.php', [
    //         'title' => 'Connexion - Le Ndanan du code'
    //     ]);
    // }

    // public function authenticate()
    // {
    //     // Traitement de l'authentification
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $email = $_POST['email'] ?? '';
    //         $password = $_POST['password'] ?? '';

    //         // Validation simple (à améliorer avec une vraie authentification)
    //         if ($email === 'admin@ndanan.com' && $password === 'admin123') {
    //             // Démarrer la session
    //             session_start();
    //             $_SESSION['user_logged'] = true;
    //             $_SESSION['user_email'] = $email;

    //             // Rediriger vers le dashboard
    //             header('Location: /list');
    //             exit;
    //         } else {
    //             // Erreur de connexion
    //             $this->renderHtml('security/login.html.php', [
    //                 'title' => 'Connexion - Le Ndanan du code',
    //                 'error' => 'Email ou mot de passe incorrect'
    //             ]);
    //         }
    //     }
    // }

    public function logout()
    {
        $this->session->destroy();
        header('Location: /');
        exit;
    }

    public function store() {}
    public function create() {}
    public function destroy() {}
    public function show() {}
    public function edit() {}
}
