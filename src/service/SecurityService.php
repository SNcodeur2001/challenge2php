<?php 
namespace App\Service;

use App\Entity\Vendeur;
use App\Repository\PersonneRepository;

class SecurityService{


    private PersonneRepository $personneRepository;

    public function __construct()
    {
        $this->personneRepository = new PersonneRepository();
    }

    public function seConnecter(String $login , String $password):?Vendeur
    {

       $vendeur = $this->personneRepository->selectByLoginAndPassword($login, $password);

       return $vendeur;

    }
}