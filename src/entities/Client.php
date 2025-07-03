<?php

namespace App\Entity;

class Client extends Personne
{

    private string $telephone;
    private array $commandes;
    public function __construct(int $id = 0, string $nom = "", string $telephone = "")
    {
        parent::__construct($id, $nom, TypeEnum::CLIENT);
        $this->telephone = $telephone;
        $this->commandes = [];
    }

    public function getCommandes(): array
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): void
    {
        $this->commandes[] = $commande;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    public static function toObject(array $tableau): static
    {
        return new static(
            $tableau['id'] ?? 0,
            $tableau['nom'] ?? '',
            $tableau['telephone'] ?? ''
        );
    }

    public function toArray(Object $object): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'telephone' => $this->getTelephone(),
            'type' => $this->getType()->value,
            'commandes' => array_map(fn(Commande $commande) => $commande->toArray($commande), $this->getCommandes())


        ];
    }

    
}
