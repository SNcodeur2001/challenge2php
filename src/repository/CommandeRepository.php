<?php
namespace App\Repository;

use App\Entity\Commande;
use App\Config\Core\Database;
use App\Entity\Client;

use function PHPSTORM_META\type;

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

    $personneRepo = new \App\Repository\PersonneRepository();
    $produitCommandeRepo = new \App\Repository\ProduitCommandeRepository();
    $factureRepo = new \App\Repository\FactureRepository();

    $commandes = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $commande = \App\Entity\Commande::toObject($row);

        // Hydrater le client
        $client = $personneRepo->findById($row['personne_id']);
        if ($client instanceof \App\Entity\Client) {
            $commande->setClient($client);
        } else {
            throw new \Exception("La personne liée à personne_id {$row['personne_id']} n'est pas un Client.");
        }

        // Hydrater les produits commandés
        $produitCommandes = $produitCommandeRepo->findByCommandeId($commande->getId());
        $commande->setProduitCommandes($produitCommandes);

        // Hydrater la facture
        $facture = $factureRepo->findByCommandeId($commande->getId());
        $commande->setFacture($facture);

        $commandes[] = $commande;
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
