<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class ParametersFactory extends Factory
{
    /**
     * A list of all vhost-scoped parameters.
     * @param string $component
     * @param string $vhost
     * @return Response
     */
    public function lists(string $component = '', string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['parameters', $component, urlencode($vhost)]
        );
    }

    /**
     * Get an individual vhost-scoped parameter
     * @param string $component
     * @param string $vhost
     * @param string $name
     * @return Response
     */
    public function get(string $component, string $vhost, string $name): Response
    {
        return $this->client->request(
            'GET',
            ['parameters', $component, urlencode($vhost), $name]
        );
    }

    /**
     * Add an individual vhost-scoped parameter
     * @param string $component
     * @param string $name
     * @param string $vhost
     * @param array $value
     * @return Response
     */
    public function put(
        string $component,
        string $name,
        string $vhost,
        array $value
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['parameters', $component, urlencode($vhost), $name],
            null,
            [
                'vhost' => urlencode($vhost),
                'component' => $component,
                'name' => $name,
                'value' => $value
            ]
        );
    }

    /**
     * Delete an individual vhost-scoped parameter
     * @param string $component
     * @param string $vhost
     * @param string $name
     * @return Response
     */
    public function delete(string $component, string $vhost, string $name): Response
    {
        return $this->client->request(
            'DELETE',
            ['parameters', $component, urlencode($vhost), $name]
        );
    }
}