<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class NodesFactory extends Factory
{
    /**
     * @return Response
     */
    public function all(): Response
    {
        return $this->client->request(
            'GET',
            ['nodes']
        );
    }

    /**
     * @param string $name
     * @param bool $memory
     * @param bool $binary
     * @return Response
     */
    public function get(string $name, bool $memory = true, bool $binary = true): Response
    {
        return $this->client->request(
            'GET',
            ['nodes', $name],
            [
                'memory' => $memory,
                'binary' => $binary
            ]
        );
    }
}