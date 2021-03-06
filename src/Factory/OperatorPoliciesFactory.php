<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class OperatorPoliciesFactory extends Factory
{
    /**
     * A list of all operator policy overrides.
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['operator-policies', urlencode($vhost)]
        );
    }

    /**
     * Get An individual operator policy
     * @param $name
     * @param string $vhost
     * @return Response
     */
    public function get(string $name, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['operator-policies', urlencode($vhost), $name]
        );
    }

    /**
     * Add An individual operator policy
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
            ['operator-policies', urlencode($vhost), $name],
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
     * Delete An individual operator policy
     * @param $name
     * @param string $vhost
     * @return Response
     */
    public function delete(string $name, string $vhost): Response
    {
        return $this->client->request(
            'DELETE',
            ['operator-policies', urlencode($vhost), $name]
        );
    }
}