<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

use Exception;
use GuzzleHttp\Client;

class HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * HttpClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function request(
        string $method,
        string $uri,
        ?array $query = null,
        ?array $body = null
    ): Response
    {
        $options = [];
        if (!empty($query)) {
            $options['query'] = array_filter($query, fn($v) => !empty($v));
        }
        if (!empty($body)) {
            $options['body'] = array_filter($body, fn($v) => !empty($v));
        }
        return new Response(
            $this->client->request($method, $uri, $options)
        );
    }
}