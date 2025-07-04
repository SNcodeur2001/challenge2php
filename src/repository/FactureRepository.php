<?php
namespace App\Repository;

use App\Entity\Facture;
use App\Entity\Commande;
use App\Entity\Paiement;
use App\Config\Core\Database;

class FactureRepository {

    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Insérer une facture dans la base de données
     */
    public function insertFacture(Facture $facture): void {
        $sql = "INSERT INTO factures (date_facture, type, montant_restant, commande_id)
                VALUES (:date, :type, :montant, :commande_id)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'date' => $facture->getDate(),
            'type' => $facture->getStatut(),
            'montant' => $facture->getMontant(),
            'commande_id' => $facture->getCommande()->getId()
        ]);

        $facture->setId((int) $this->pdo->lastInsertId());
    }

    /**
     * Récupérer toutes les factures
     */
    public function selectAllFacture(): array {
        $sql = "SELECT * FROM facture";
        $stmt = $this->pdo->query($sql);
        $factures = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $facture = Facture::toObject($row);
            $factures[] = $facture;
        }

        return $factures;
    }

    /**
     * Récupérer une facture par son ID avec sa commande
     */
    public function selectFactureCommande(int $id): ?Facture {
        $sql = "SELECT f.*, c.id AS commande_id, c.date_commande, c.personne_id
                FROM facture f
                JOIN commande c ON f.commande_id = c.id
                WHERE f.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            return Facture::toObject($row);
        }
        return null;
    }

    /**
     * Récupérer toutes les factures avec leur commande
     */
    public function selectFactureProduit(): array {
        $stmt = $this->pdo->query('
            SELECT f.id, f.date_facture, f.type, f.montant_restant, c.id AS commande_id
            FROM facture f
            JOIN commandes c ON f.commande_id = c.id
        ');

        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $results[] = Facture::toObject($row);
        }
        return $results;
    }

    /**
     * Récupérer une facture par son ID de commande
     */
    public function findByCommandeId(int $commandeId): ?Facture {
        $stmt = $this->pdo->prepare('SELECT * FROM facture WHERE commande_id = :commande_id');
        $stmt->execute(['commande_id' => $commandeId]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? \App\Entity\Facture::toObject($row) : null;
    }
}