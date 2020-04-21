<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class GlobalParametersFactory extends Factory
{
    /**
     * @return Response
     */
    public function lists(): Response
    {
        return $this->client->request(
            'GET',
            ['global-parameters']
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function get(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['global-parameters', $name]
        );
    }

    /**
     * @param string $name
     * @param array $value
     * @return Response
     */
    public function put(
        string $name,
        array $value
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['global-parameters', $name],
            null,
            [
                'name' => $name,
                'value' => $value
            ]
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function delete(string $name): Response
    {
        return $this->client->request(
            'DELETE',
            ['global-parameters', $name]
        );
    }
}