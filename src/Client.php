<?php
declare(strict_types=1);

namespace Dragonmantank\ActiveCampaign;

use Dragonmantank\Plinth\Client as PlinthClient;
use Dragonmantank\Plinth\ClientInterface;
use Laminas\Diactoros\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected string $baseURL;

    public function __construct(
        protected string $accountURL,
        protected string $accountKey,
        protected ?ClientInterface $plinth = null,
    ) {
        $this->baseURL = $accountURL . '/api/3/';

        if (!$this->plinth) {
            $accountKey = $this->accountKey;
            $this->plinth = new PlinthClient($this->baseURL, [
                'authentication_handler' => function(RequestInterface $r) use ($accountKey) {
                    return $r->withAddedHeader('Api-Token', $accountKey);
                }
            ]);
        }
    }

    public function get(string $uri, array $queryParams = []): array
    {
        return $this->plinth->get($uri, $queryParams, );
    }

    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->plinth->send($request);
    }
}