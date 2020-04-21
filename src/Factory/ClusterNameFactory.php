<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class ClusterNameFactory extends Factory
{
    /**
     * @return Response
     */
    public function get(): Response
    {
        return $this->client->request(
            'GET',
            ['cluster-name']
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function put(string $name): Response
    {
        return $this->client->request(
            'PUT',
            ['cluster-name'],
            null,
            [
                'name' => $name
            ]
        );
    }
}