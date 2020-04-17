<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use JsonException;

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
     * @param string $method
     * @param array $uri
     * @param array|null $query
     * @param array|null $body
     * @return Response
     * @inheritDoc
     */
    public function request(
        string $method,
        array $uri,
        ?array $query = null,
        ?array $body = null
    ): Response
    {
        try {
            $uri = array_filter($uri, fn($v) => !empty($v));
            $options = [];
            if (!empty($query)) {
                $options['query'] = array_filter($query, fn($v) => $v !== null);
            }
            if (!empty($body)) {
                $options['json'] = array_filter($body, fn($v) => $v !== null);
            }
            return Response::make(
                $this->client->request($method, implode('/', $uri), $options)
            );
        } catch (JsonException $exception) {
            return Response::bad($exception->getMessage());
        } catch (BadResponseException $exception) {
            return Response::bad($exception->getMessage());
        }
    }
}