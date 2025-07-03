<?php

//route/route.web.php
use App\Config\Core\Router;

// Définition des routes
Router::$routes = [
    "/commande" => [
        "controller" => "App\\Controller\\CommandeController",
        "action" => "create"
    ],
    "/list" => [
        "controller" => "App\\Controller\\CommandeController",
        "action" => "index"
    ],
    "/facture" => [
        "controller" => "App\\Controller\\FactureController",
        "action" => "show"
    ]
];

// Appel du routeur
Router::resolve();
