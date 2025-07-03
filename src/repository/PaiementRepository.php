<?php
namespace App\Repository;

use App\Entity\Paiement;
use App\Entity\Vendeur;
use App\Entity\Facture;
use App\Entity\StatutEnum;
use App\Config\Core\Database;

class PaiementRepository
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Récupérer tous les paiements
     */
    public function selectAllPaiement(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM paiement");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $paiements = [];
        foreach ($rows as $row) {
            $paiements[] = Paiement::toObject($row);
        }
        return $paiements;
    }

    /**
     * Insérer un nouveau paiement
     */
    public function insertPaiement(Paiement $paiement): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO paiement (montant, date_paiement, facture_id, personne_id, type)
            VALUES (:montant, :date_paiement, :facture_id, :personne_id, :type)
        ");

        $stmt->execute([
            'montant'       => $paiement->getMontant(),
            'date_paiement' => $paiement->getDate(),
            'facture_id'    => $paiement->getFacture()->getId(),
            'personne_id'   => $paiement->getVendeur()->getId(),
            'type'          => $paiement->getStatut()->value,
        ]);
    }

    /**
     * Mettre à jour le statut d’un paiement
     */
    public function updateStatut(int $id, StatutEnum $statut): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE paiement SET type = :type WHERE id = :id
        ");

        $stmt->execute([
            'type' => $statut->value,
            'id'   => $id
        ]);
    }
}