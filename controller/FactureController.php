<?php 

namespace App\Controller;
use App\Config\Core\AbstractController;
class FactureController extends AbstractController {

    public function index() {
        // Logique pour afficher la liste des factures
    }

    public function create() {
        // Logique pour créer une nouvelle facture
    }

    public function store() {
        // Logique pour stocker une nouvelle facture
    }

    public function show() {
        // Logique pour afficher une facture spécifique
        $this->renderHtml('commande/facture.html.php');
    }

    public function edit() {
        // Logique pour éditer une facture spécifique
    }

    public function update() {
        // Logique pour mettre à jour une facture spécifique
    }

    public function destroy() {
        // Logique pour supprimer une facture spécifique
    }
}