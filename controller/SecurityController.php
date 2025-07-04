<?php

namespace App\Controller;

use App\Config\Core\AbstractController;

class SecurityController extends AbstractController
{
    public function index()
    {
        // Rediriger vers la page de connexion
        $this->login();
    }

    public function login()
    {
        // Afficher le formulaire de connexion
        $this->renderHtmlLogin('security/login.html.php', [
            'title' => 'Connexion - Le Ndanan du code'
        ]);
    }

    public function authenticate()
    {
        // Traitement de l'authentification
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Validation simple (à améliorer avec une vraie authentification)
            if ($email === 'admin@ndanan.com' && $password === 'admin123') {
                // Démarrer la session
                session_start();
                $_SESSION['user_logged'] = true;
                $_SESSION['user_email'] = $email;
                
                // Rediriger vers le dashboard
                header('Location: /list');
                exit;
            } else {
                // Erreur de connexion
                $this->renderHtml('security/login.html.php', [
                    'title' => 'Connexion - Le Ndanan du code',
                    'error' => 'Email ou mot de passe incorrect'
                ]);
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function store() {}
    public function create() {}
    public function destroy() {}
    public function show() {}
    public function edit() {}
}