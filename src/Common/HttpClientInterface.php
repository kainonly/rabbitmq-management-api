<?php
declare(strict_types=1);

namespace RabbitMQ\API\Common;

interface HttpClientInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param array|null $query
     * @param array|null $body
     * @return Response
     */
    public function request(
        string $method,
        string $uri,
        ?array $query = null,
        ?array $body = null
    ): Response;
}