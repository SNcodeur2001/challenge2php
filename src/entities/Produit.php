<?php

namespace App\Entity;

use App\Config\Core\AbstractEntity;

class Produit extends AbstractEntity
{
    private int $id;
    private int $qte_stock;
    private float $prix;

    public function __construct(int $id=0, int $qte_stock=0, float $prix=0.0)
    {
        $this->id = $id;
        $this->qte_stock = $qte_stock;
        $this->prix = $prix;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getQteStock(): string
    {
        return $this->qte_stock;
    }

    public function setQteStock(string $qte_stock): void
    {
        $this->qte_stock = $qte_stock;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

   public function toArray(object $object): array
   {
        return [
            'id' => $object->getId(),
            'qte_stock' => $object->getQteStock(),
            'prix' => $object->getPrix()
        ];
   }

   public static function toObject(array $tableau): static
    {
        $produit = new static();
        $produit->setId($tableau['id'] ?? 0);
        $produit->setQteStock($tableau['qte_stock'] ?? 0);
        $produit->setPrix($tableau['prix'] ?? 0.0);

        return $produit;
    }

}
