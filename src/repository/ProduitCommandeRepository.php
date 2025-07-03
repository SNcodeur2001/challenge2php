<?php
namespace App\Repository;

use App\Entity\ProduitCommande;
use App\Config\Core\Database;

class ProduitCommandeRepository
{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }
  

    // Récupérer tous les ProduitCommande
    public function selectAllProduit(): array
    {
        $stmt = $this->pdo->query('
            SELECT id, quantiteCommande, montant, commande_id, produit_id
            FROM produit_commande
        ');

        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $results[] = ProduitCommande::toObject($row);
        }
        return $results;
    }
    public function SelectQuantiteFromProduit(): array
    {
        $stmt = $this->pdo->query('
            SELECT quantiteCommande, produit_id
            FROM produit_commande
        ');

        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $results[] = ProduitCommande::toObject($row);
        }
        return $results;
    }

    // Enregistrer (insérer ou mettre à jour) un ProduitCommande
    // public function save(ProduitCommande $produitCommande): bool
    // {
    //     if ($produitCommande->getId() > 0) {
    //         // update
    //         $stmt = $this->pdo->prepare('
    //             UPDATE produit_commande SET
    //                 quantiteCommande = :quantiteCommande,
    //                 montant = :montant,
    //                 commande_id = :commande_id,
    //                 produit_id = :produit_id
    //             WHERE id = :id
    //         ');
    //         return $stmt->execute([
    //             'quantiteCommande' => $produitCommande->getQuantiteCommande(),
    //             'montant' => $produitCommande->getMontant(),
    //             'commande_id' => $produitCommande->getCommande()->getId(),
    //             'produit_id' => $produitCommande->getProduit()->getId(),
    //             'id' => $produitCommande->getId(),
    //         ]);
    //     } else {
    //         // insert
    //         $stmt = $this->pdo->prepare('
    //             INSERT INTO produit_commande (quantiteCommande, montant, commande_id, produit_id)
    //             VALUES (:quantiteCommande, :montant, :commande_id, :produit_id)
    //         ');
    //         $success = $stmt->execute([
    //             'quantiteCommande' => $produitCommande->getQuantiteCommande(),
    //             'montant' => $produitCommande->getMontant(),
    //             'commande_id' => $produitCommande->getCommande()->getId(),
    //             'produit_id' => $produitCommande->getProduit()->getId(),
    //         ]);
    //         if ($success) {
    //             $produitCommande->setId((int)$this->pdo->lastInsertId());
    //         }
    //         return $success;
    //     }
    // }

    // // Supprimer un ProduitCommande par ID
    // public function delete(int $id): bool
    // {
    //     $stmt = $this->pdo->prepare('DELETE FROM produit_commande WHERE id = :id');
    //     return $stmt->execute(['id' => $id]);
    // }
}