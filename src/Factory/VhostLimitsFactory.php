<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class VhostLimitsFactory extends Factory
{
    /**
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['vhost-limits', urlencode($vhost)]
        );
    }

    /**
     * @param string $vhost
     * @param string $name
     * @param int $value
     * @return Response
     */
    public function put(string $vhost, string $name, int $value): Response
    {
        return $this->client->request(
            'PUT',
            ['vhost-limits', urlencode($vhost), $name],
            null,
            [
                'value' => $value
            ]
        );
    }

    /**
     * @param string $vhost
     * @param string $name
     * @return Response
     */
    public function delete(string $vhost, string $name): Response
    {
        return $this->client->request(
            'DELETE',
            ['vhost-limits', urlencode($vhost), $name]
        );
    }

}