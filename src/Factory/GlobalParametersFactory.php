<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class GlobalParametersFactory extends Factory
{
    /**
     * A list of all global parameters.
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
     * Get an individual global parameter
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
     * Add an individual global parameter
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
     * Delete an individual global parameter
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