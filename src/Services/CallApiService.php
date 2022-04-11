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
    public function getDatas($url=null, bool $pathAPIExter): array
    {
        //Gestion de la construction de la requete API svt envirronements
        if ($pathAPIExter == false)
        {
            $path=$_ENV['APP_SERVER'];
        } elseif ($_ENV['APP_ENV'] == 'dev')
        {
            //$path=$_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL'];
            $path='http://127.0.0.1:8000/';
        } else {
            $path='http://localhost:83';
        }
        $response = $this->client->request(
            'GET',
            $path.$url
        );

        return $response->toArray();
    }
}