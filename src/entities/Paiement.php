<?php

namespace App\Entity;

use App\Config\Core\AbstractEntity;

class Paiement extends AbstractEntity
{

    private int $id;
    private float $montant;
    private Vendeur $vendeur;
    private Facture $facture;
    private string $date;
    private StatutEnum $statut;

    public function __construct(int $id, float $montant)
    {
        $this->id = $id;
        $this->montant = $montant;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getMontant(): string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): void
    {
        $this->montant = $montant;
    }

    public function getVendeur(): Vendeur
    {
        return $this->vendeur;
    }
    public function setVendeur(Vendeur $vendeur): void
    {
        $this->vendeur = $vendeur;
    }

    public function getFacture(): Facture
    {
        return $this->facture;
    }
    public function setFacture(Facture $facture): void
    {
        $this->facture = $facture;
    }
    public function toArray(Object $object): array
    {
        return [
            'id' => $this->id,
            'montant' => $this->montant,
            'vendeur' => $this->vendeur->toArray($object),
            'facture' => $this->facture->toArray($object),
        ];
    }

    public static function toObject(array $tableau): static
    {
        $paiement = new static(
            $tableau['id'] ?? 0,
            $tableau['montant'] ?? 0.0
        );
        if (isset($tableau['vendeur'])) {
            $paiement->setVendeur(Vendeur::toObject($tableau['vendeur']));
        }
        if (isset($tableau['facture'])) {
            $paiement->setFacture(Facture::toObject($tableau['facture']));
        }
        return $paiement;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getStatut(): StatutEnum
    {
        return $this->statut;
    }

    public function setStatut(StatutEnum $statut): void
    {
        $this->statut = $statut;
    }
}
