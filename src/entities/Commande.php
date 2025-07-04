<?php

namespace App\Entity;

use App\Config\Core\AbstractEntity;

class Commande extends AbstractEntity
{
    private int $id;
    private string $date;
    private Client $client;
    private Vendeur $vendeur;
    private array $produitCommandes;
    private ?Facture $facture = null;

    public function __construct(int $id=0, string $date="")
    {
        $this->id = $id;
        $this->date = $date;
        $this->produitCommandes = [];
        $this->client = new Client();
        $this->vendeur = new Vendeur();
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }
    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
    public function getVendeur(): Vendeur
    {
        return $this->vendeur;
    }
    public function setVendeur(Vendeur $vendeur): void
    {
        $this->vendeur = $vendeur;
    }
    public function getProduitCommandes(): array
    {
        return $this->produitCommandes;
    }
    public function setProduitCommandes(array $produitCommandes): void
    {
        $this->produitCommandes = $produitCommandes;
    }
    public function addProduitCommande(Produit $produit): void
    {
        $this->produitCommandes[] = $produit;
    }

    public function setFacture(?Facture $facture): void
    {
        $this->facture = $facture;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function getStatut(): string
    {
        return $this->facture ? $this->facture->getStatut()->value : 'En cours';
    }

    public static function toObject(array $tableau): static
    {
        return new static(
            $tableau['id'] ?? 0,
            $tableau['date'] ?? ''
            
        );
    }

    public function toArray(Object $object):array{
        return [
            'id' => $this->id,
            'date' => $this->date,
            'client' => $this->client->toArray($this->client),
            'vendeur' => $this->vendeur->toArray($this->vendeur),
            'produitCommandes' => array_map(fn(ProduitCommande $produit) => $produit->toArray($produit), $this->produitCommandes)            
        ];
    }



}
