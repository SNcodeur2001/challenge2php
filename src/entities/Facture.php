<?php

namespace App\Entity;

use App\Config\Core\AbstractEntity;

class Facture extends AbstractEntity
{
    private int $id;
    private string $date;
    private float $montant;
    private Commande $commande;
    private StatutEnum $statut;
    private ?Paiement $paiement = null;

    public function __construct(int $id, string $date, float $montant)
    {
        $this->id = $id;
        $this->date = $date;
        $this->montant = $montant;
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
    public function getStatut(): StatutEnum
    {
        return $this->statut;
    }
    public function setStatut(StatutEnum $statut): void
    {
        $this->statut = $statut;
    }
    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): void
    {
        $this->paiement = $paiement;
    }
      public static function toObject(array $tableau): static
    {
        return new static(
            $tableau['id'],
            $tableau['date'],
            $tableau['montant']
        );
    }

    public function toArray(Object $object):array{
        return [
            'id' => $this->id,
            'date' => $this->date,
            'montant' => $this->montant,
          
            
        ];
    }

    public function toJson(Object $object): string
    {
        return json_encode($this->toArray($object));
    }
}
