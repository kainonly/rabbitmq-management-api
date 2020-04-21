<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class PoliciesFactory extends Factory
{
    /**
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['policies', urlencode($vhost)]
        );
    }

    /**
     * @param $name
     * @param string $vhost
     * @return Response
     */
    public function get(string $name, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['policies', urlencode($vhost), $name]
        );
    }

    /**
     * @param string $name
     * @param string $vhost
     * @param string $pattern
     * @param array $definition
     * @param int $priority
     * @param string $applyTo
     * @return Response
     */
    public function put(
        string $name,
        string $vhost,
        string $pattern,
        array $definition,
        int $priority = 0,
        string $applyTo = 'all'
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['policies', urlencode($vhost), $name],
            null,
            [
                'pattern' => $pattern,
                'definition' => $definition,
                'priority' => $priority,
                'apply-to' => $applyTo
            ]
        );
    }

    /**
     * @param $name
     * @param string $vhost
     * @return Response
     */
    public function delete(string $name, string $vhost): Response
    {
        return $this->client->request(
            'DELETE',
            ['policies', urlencode($vhost), $name]
        );
    }
}