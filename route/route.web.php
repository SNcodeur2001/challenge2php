<?php

use App\Config\Core\Router;
use App\Controller\CommandeController;
use App\Controller\SecurityController;

// Routes de sécurité
Router::get('/', SecurityController::class, 'index');
Router::get('/login', SecurityController::class, 'login');
Router::post('/authenticate', SecurityController::class, 'authenticate');
Router::get('/logout', SecurityController::class, 'logout');

// Routes des commandes (protégées)
Router::get('/list', CommandeController::class, 'index');
Router::get('/facture', CommandeController::class, 'show');
Router::get('/form', CommandeController::class, 'create');

// Résoudre la route
Router::resolve();
