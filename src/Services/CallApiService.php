<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * CallApiService accèdeaux données des API
 */
class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    /**
     * Fonction permettant de remonter les données des API exter suivant une url
     *
     * @param  string $url
     * @return array
     */
    public function getDatas($url=null): array
    {
        //$projectDir = $this->params->get('app.contents_dir');;
        $response = $this->client->request(
            'GET',
            $_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL'].$url
        );

        return $response->toArray();
    }
}