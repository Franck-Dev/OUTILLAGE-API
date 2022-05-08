<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Controle;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Services\GestDemande;
use Symfony\Component\Security\Core\Security;

class ControleDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     *
     * @var Security
     */
    private $_security;

    private $_demande;

    public function __construct(EntityManagerInterface $entityManager, GestDemande $demande, Security $security)
    {
        $this->_entityManager = $entityManager;
        $this->_security = $security;
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
            $data->setUserCreat('/api/users/'.$this->_security->getUser()->getId());
            $this->_demande->NewDemande($data);

        } else {
            $data->setModifiedAt(new \DateTimeImmutable());
            $data->setUserModif('/api/users/'.$this->_security->getUser()->getId());
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