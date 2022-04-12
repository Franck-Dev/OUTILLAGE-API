<?php
// api/src/DataProvider/ControleCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Tool;
use App\Entity\Controle;
use App\Entity\Demandes;
use App\Entity\MaintenanceItems;
use App\Services\CallApiService;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\DenormalizedIdentifiersAwareItemDataProviderInterface;
use App\Entity\Equipement;

final class ControleItemDataProvider implements DenormalizedIdentifiersAwareItemDataProviderInterface
{
    private $itemDataProvider;
    private $callAPIService;

    public function __construct(ItemDataProviderInterface $itemDataProvider, CallApiService $callAPIService)
    {
        $this->itemDataProvider = $itemDataProvider;
        $this->callAPIService=$callAPIService;
    }

    public function getItem(string $resourceClass, /* array */ $id, string $operationName = null, array $context = [])
    {
        
        $item = $this->itemDataProvider->getItem($resourceClass, $id, $operationName, $context);
        switch ($resourceClass) {
            case Demandes::class:
                $method='get'.$item->getType();
                $item->$method()->setDemandeur($this->callAPIService->getDatas($item->$method()->getUserCreat(),false));
                break;
            case Tool::class:
                //Si programme_avion et division existe, on les remonte 
                if ($item->getprogrammeAvion())
                {
                    $prog=$this->callAPIService->getDatas($item->getprogrammeAvion(),false);
                    $item->setProgramme($prog);
                }
                if ($item->getSecteur())
                {
                    $div=$this->callAPIService->getDatas($item->getSecteur(),false);
                    $item->setDivision($div);
                }
                break;
            case Equipement::class:
                //Idem pour le site sur l'equipement
                if ($item->getSite())
                {
                    $site=$this->callAPIService->getDatas($item->getSite(),false);
                    $item->setSiteUtil($site);
                }
                break;
            default:
                $item=$item->setDemandeur($this->callAPIService->getDatas($item->getUserCreat(),false));
                break;
        }
        if ($resourceClass == Demandes::class)
        {
            
        } else {
            
        }
        return $item;
    }
}
