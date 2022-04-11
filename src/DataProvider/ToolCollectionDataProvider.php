<?php
// api/src/DataProvider/ToolCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Tool;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Services\CallApiService;

final class ToolCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
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
            case Tool::class:
                return Tool::class;
                break;
            case Equipement::class:
                return Equipement::class;
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
                case Tool::class:
                    $prog=$this->callAPIService->getDatas($item->getprogrammeAvion());
                    $item->setProgramme($prog);
                    $div=$this->callAPIService->getDatas($item->getSecteur());
                    $item->setDivision($div);
                    break;
                case Equipement::class:
                    $site=$this->callAPIService->getDatas($item->getSite());
                    $item->setSiteUtil($site);
                    break;
                default:
                    break;
            }
        }
        return $datas;
    }
}
