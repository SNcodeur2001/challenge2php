<?php

namespace App\Entity;

use App\Config\Core\AbstractEntity;

abstract class Personne extends AbstractEntity
{

    protected int $id;
    protected string $nom;
    protected TypeEnum $type;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function __construct(int $id, string $nom, TypeEnum $type)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->type = $type;
    }
    public function getType(): TypeEnum
    {
        return $this->type;
    }
    public function setType(TypeEnum $type): void
    {
        $this->type = $type;
    }
}
