<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class DefinitionsFactory extends Factory
{
    /**
     * The server definitions for a given virtual host
     * @param string $vhost
     * @return Response
     */
    public function get(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['definitions', urlencode($vhost)]
        );
    }

    /**
     * upload an existing set of definitions
     * @param array $data
     * @param string $vhost
     * @return Response
     */
    public function post(array $data, string $vhost = ''): Response
    {
        return $this->client->request(
            'POST',
            ['definitions', urlencode($vhost)],
            null,
            $data
        );
    }
}