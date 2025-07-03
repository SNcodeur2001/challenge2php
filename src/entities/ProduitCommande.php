<?php

namespace App\Entity;

use App\Config\Core\AbstractEntity;

class ProduitCommande extends AbstractEntity
{
    private int $id;
    private int $quantiteCommande;
    private float $montant;
    private Commande $commande;
    private Produit $produit;
    public function __construct(int $quantiteCommande, float $montant, int $id = 0)
    {

        $this->quantiteCommande = $quantiteCommande;
        $this->montant = $montant;
        $this->commande = new Commande();
        $this->produit = new Produit();
        $this->id = $id;
    }

    public function getQuantiteCommande(): int
    {
        return $this->quantiteCommande;
    }

    public function setQuantiteCommande(int $quantiteCommande): void
    {
        $this->quantiteCommande = $quantiteCommande;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }

    public function getCommande(): Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): void
    {
        $this->commande = $commande;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProduit(): Produit
    {
        return $this->produit;
    }

    public function setProduit(Produit $produit): void
    {
        $this->produit = $produit;
    }

  public function toArray(object $object): array
  {
        return [
            'id' => $this->id,
            'quantiteCommande' => $this->quantiteCommande,
            'montant' => $this->montant,
            'commande' => $this->commande->toArray($object),
            'produit' => $this->produit->toArray($object)
        ];
  }

    public static function toObject(array $tableau): static
    {
        return new static(
            $tableau['quantiteCommande'] ?? 0,
            $tableau['montant'] ?? 0.0,
            $tableau['id'] ?? 0
        );
    }
}
