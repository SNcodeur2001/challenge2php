<?php

namespace App\Repository;

use App\Entity\Personne;
use App\Entity\Client;
use App\Entity\Vendeur;
use App\Config\Core\Database;

class PersonneRepository
{
    private \PDO $pdo;

    public function __construct()
    {

        $this->pdo = Database::getConnection();
    }

    public function selectByLoginAndPassword(string $login, string $password): Vendeur | null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM personne WHERE login = :login AND password = :password");
        $stmt->execute(['login' => $login, 'password' => $password]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        

        if (!$row) {
            return null;
        }

        $vendeur = Vendeur::toObject($row);
        
        return $vendeur;
    }







































    // private \PDO $pdo;

    // public function __construct() {
    //     $this->pdo = Database::getConnection();
    // }

    // public function selectAll(): array {
    //     $stmt = $this->pdo->query("SELECT * FROM personne");
    //     $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    //     $personnes = [];
    //     foreach ($rows as $row) {
    //         $personnes[] = $this->mapToEntity($row);
    //     }
    //     return $personnes;
    // }

    public function findById(int $id): ?Personne {
        $stmt = $this->pdo->prepare("SELECT * FROM personne WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row ? $this->mapToEntity($row) : null;
    }

    private function mapToEntity(array $row): Personne {
        if (isset($row['type']) && $row['type'] === 'Client') {
            return Client::toObject($row);
        } else {
            return Vendeur::toObject($row);
        }
    }

    // Ajoute ici d'autres méthodes (save, update, delete) selon tes besoins
}
