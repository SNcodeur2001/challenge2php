<?php

namespace App\Entity;


 class Vendeur extends Personne
{

    private string $login;
    private string $password;
    private ?array $commandes = null;
    private ?array $paiements = null;

    public function __construct(int $id = 0, String $nom = "", String $login = "", String $password = " ")
    {
        parent::__construct($id, $nom, TypeEnum::VENDEUR);
        $this->login = $login;
        $this->password = $password;
       
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getpassword(): string
    {
        return $this->password;
    }

    public function setpassword(string $password): void
    {
        $this->password = $password;
    }
    public function getCommandes(): array
    {
        return $this->commandes;
    }
    public function addCommande(Commande $commande): void
    {
        $this->commandes[] = $commande;
    }
    public function getPaiements(): array
    {
        return $this->paiements;
    }
    public function addPaiement(Paiement $paiement): void
    {
        $this->paiements[] = $paiement;
    }



public static function toObject(array $row): static
    {
        return new static(
            $row['id'],
            $row['nom'],
            $row['login'],
            $row['password']
        );
    }

    public function toArray(Object $object): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'password' => $this->password,
            'nom' => $this->nom,
            
        ];
    }
    public function toJson(Object $object): string
    {
        return json_encode($this->toArray($object));
    }

}
