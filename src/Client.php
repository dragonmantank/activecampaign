<?php
declare(strict_types=1);

namespace Dragonmantank\ActiveCampaign;

use GuzzleHttp\Client as GuzzleHttpClient;
use Laminas\Diactoros\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected GuzzleHttpClient $guzzle;

    protected string $baseURL;

    public function __construct(protected string $accountURL, protected string $accountKey)
    {
        $this->baseURL = $accountURL . '/api/3/';

    }

    public function get(string $uri, array $queryParams = []): array
    {
        $url = $this->baseURL . $uri;
        if ($queryParams) {
            $url .= '?' . http_build_query($queryParams);
        }

        $response = $this->send(new Request($queryParams));
        

        return json_decode($response->getBody()->getContents(), true);
    }

    public function send(RequestInterface $request): ResponseInterface
    {
        $request = $request->withAddedHeader('Api-Token', $this->accountKey);

        return $this->guzzle->sendRequest($request);
    }
}