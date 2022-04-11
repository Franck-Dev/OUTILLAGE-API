<?php
// api/src/DataProvider/ControleCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Controle;
use App\Entity\Demandes;
use App\Entity\MaintenanceItems;
use App\Services\CallApiService;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\DenormalizedIdentifiersAwareItemDataProviderInterface;

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
        if ($resourceClass == Demandes::class)
        {
            $method='get'.$item->getType();
            $item->$method()->setDemandeur($this->callAPIService->getDatas($item->$method()->getUserCreat(),false));
        } else {
            $item=$item->setDemandeur($this->callAPIService->getDatas($item->getUserCreat(),false));
        }
        return $item;
    }
}
