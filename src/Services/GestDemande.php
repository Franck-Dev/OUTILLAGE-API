<?php

namespace App\Services;

use App\Entity\Controle;
use App\Entity\Demandes;
use App\Entity\Maintenance;
use Doctrine\ORM\EntityManagerInterface;

class GestDemande
{    
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_entityManager = $entityManager;
    }
    
    /**
     * Création d'une nouvelle demande suite à génération d'une opération de contrôle, de maintenance ou d'un nouvel outillage
     *
     * @param  mixed $operation
     * @param  mixed $params
     */
    public function NewDemande($operation, $params=null) {

        //Initialisation de la demande
        $demande=new Demandes;
        //Récupération de l'opération avec ses données, avec intégration dans une nouvelle demande
        if ($operation instanceof Controle) {
            $demande->setControle($operation);
        } elseif ($operation instanceof Maintenance){
            $demande->setMaintenance($operation);
        } else {
            $demande->setSBO($operation);
        }
        //Rajout des données de la demande
        $demande->setCreatedAt(new \DateTimeImmutable);
        $demande->setStatut('NOUVELLE');
        //Enregistrement de la demande
        $this->_entityManager->persist($demande);
        $this->_entityManager->flush();
    }
}
