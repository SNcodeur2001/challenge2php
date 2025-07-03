<?php

namespace App\Service;

use App\Repository\CommandeRepository;
use App\Entity\Commande;

class CommandeService
{
    private CommandeRepository $repo;

    public function __construct()
    {
        $this->repo = new CommandeRepository();
    }

    public function enregistrerCommande(Commande $commande): void
    {
        // Appelle la méthode du repository pour enregistrer
        $this->repo->insertCommande($commande);
    }

    public function listerCommandes(): array
    {
        return $this->repo->selectAllCommande();
    }

    // Ajoute d'autres méthodes selon les use cases
}