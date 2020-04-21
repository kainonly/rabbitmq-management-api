<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class NodesFactory extends Factory
{
    /**
     * A list of nodes in the RabbitMQ cluster.
     * @return Response
     */
    public function lists(): Response
    {
        return $this->client->request(
            'GET',
            ['nodes']
        );
    }

    /**
     * An individual node in the RabbitMQ cluster
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