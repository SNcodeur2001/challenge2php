<?php
namespace App\Repository;

use App\Entity\Commande;
use App\Config\Core\Database;

class CommandeRepository {

    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Enregistrer une commande
     */
    public function insertCommande(Commande $commande): void {
        $sql = "INSERT INTO commande (date_commande, personne_id)
                VALUES (:date_commande, :personne_id)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'date_commande' => $commande->getDate(),
            'personne_id' => $commande->getClient()->getId()
        ]);

        // Récupérer l'id généré
        $commandeId = $this->pdo->lastInsertId();
        $commande->setId((int)$commandeId);
    }

    /**
     * Trouver toutes les commandes
     */
    public function selectAllCommande(): array {
        $sql = "SELECT * FROM commande";
        $stmt = $this->pdo->query($sql);

        $commandes = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $commandes[] = Commande::toObject($row);
        }

        return $commandes;
    }

    /**
     * Trouver une commande par ID client
     */
    public function selectCommandeByClient(int $id): ?Commande {
        $sql = "SELECT * FROM commande WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return Commande::toObject($row);
        }

        return null;
    }

    /**
     * Trouver les commandes par produit
     */
    public function selectCommandeByProduit(int $produitId): array {
        $sql = "SELECT * FROM commande WHERE produit_id = :produit_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['produit_id' => $produitId]);

        $commandes = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $commandes[] = Commande::toObject($row);
        }

        return $commandes;
    }
}
