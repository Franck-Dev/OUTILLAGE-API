<?php
// api/src/DataProvider/ControleCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Controle;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Entity\Demandes;
use App\Entity\Maintenance;
use App\Entity\MaintenanceItems;
use App\Services\CallApiService;
use Doctrine\ORM\Query\AST\NewObjectExpression;

final class ControleCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $collectionDataProvider;
    private $callAPIService;

    public function __construct(CollectionDataProviderInterface $collectionDataProvider, CallApiService $callAPIService)
    {
        $this->collectionDataProvider = $collectionDataProvider;
        $this->callAPIService=$callAPIService;
    }
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        switch ($resourceClass) {
            case Controle::class:
                return Controle::class;
                break;
            case Maintenance::class:
                return Maintenance::class;
                break;
            case MaintenanceItems::class:
                return MaintenanceItems::class;
                break;
            case SBO::class:
                return SBO::class;
                break;
            case Demandes::class:
                return Demandes::class;
                break;
            default:
                return false;
                break;
        }
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Récupération des données de tous les Controles
        $datas= $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);
        // On ajoute les données user(api-usine) pour le demandeur
        foreach ($datas as $item) {
            switch ($resourceClass) {
                case Controle::class:
                    $user=$this->callAPIService->getDatas($item->getUserCreat(),false);
                    $item->setDemandeur($user);
                    break;
                case Maintenance::class:
                    $user=$this->callAPIService->getDatas($item->getUserCreat(),false);
                    $item->setDemandeur($user);
                    if ($item->getUserValideur())
                    {
                        $user=$this->callAPIService->getDatas($item->getUserValideur(),false);
                        $item->setValideur($user);
                    }
                    break;
                case MaintenanceItems::class:
                    //Idem pour le responsable et le réalisateur
                    if ($item->getRespo())
                    {
                        $user=$this->callAPIService->getDatas($item->getRespo(),false);
                        $item->setPorteur($user);
                    }
                    if ($item->getUserReal())
                    {
                        $user=$this->callAPIService->getDatas($item->getUserReal(),false);
                        $item->setRealisateur($user);
                    }
                    break;
                case SBO::class:
                    $user=$this->callAPIService->getDatas($item->getUserCreat(),false);
                    $item->setDemandeur($user);
                    break;
                case Demandes::class:
                    //Gestion du groupe d'affectation avec les users
                    if ($item->getGroupeAffectation())
                    {
                        $groupe=$this->callAPIService->getDatas($item->getGroupeAffectation(),false);
                        $users=[];
                        foreach ($groupe['population'] as $user=>$iri) {
                            $users[]=$this->callAPIService->getDatas($iri,true);
                        }
                        $item->setAffectation($users);
                    }
                    //Gestion des sous-objets pour les users suivant type de demande
                    $method='get'.$item->getType();
                    $item->$method()->setDemandeur($this->callAPIService->getDatas($item->$method()->getUserCreat(),false));
                    break;
                default:
                    break;
            }
        }
        return $datas;
    }
}
