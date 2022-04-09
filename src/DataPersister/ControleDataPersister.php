<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Controle;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Services\GestDemande;

class ControleDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;
    private $_demande;

    public function __construct(EntityManagerInterface $entityManager, GestDemande $demande)
    {
        $this->_entityManager = $entityManager;
        $this->_demande = $demande;
    }

    /**
     * {@inheritdoc}
     */
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Controle;
        
    }

    public function persist($data, array $context = [])
    {
        // Si création on renvoie la date de création, sinon la date de bmodification
        if (!$data->getCreatedAt()) {
            $data->setCreatedAt(new \DateTimeImmutable());
            $this->_demande->NewDemande($data);

        } else {
            $data->setModifiedAt(new \DateTimeImmutable());
            $this->_entityManager->persist($data);
            $this->_entityManager->flush();
        }
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}