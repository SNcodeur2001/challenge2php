<?php

namespace App\Entity;

use App\Config\Core\AbstractEntity;

class Facture extends AbstractEntity
{
    private int $id;
    private string $date;
    private float $montant_restant;
    private Commande $commande;
    private StatutEnum $statut;
    private ?Paiement $paiement = null;

    public function __construct(int $id, string $date, float $montant_restant)
    {
        $this->id = $id;
        $this->date = $date;
        $this->montant_restant = $montant_restant;
        $this->statut = StatutEnum::IMPAYE; // Assuming a default status
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
        return $this->montant_restant;
    }

    public function setMontant(float $montant_restant): void
    {
        $this->montant_restant = $montant_restant;
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
            $tableau['date_facture'],
            (float)($tableau['montant_restant'] ?? 0)
        );
    }

    public function toArray(Object $object): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'montant' => $this->montant_restant,


        ];
    }

    public function toJson(Object $object): string
    {
        return json_encode($this->toArray($object));
    }
}
