<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class TopicPermissionsFactory extends Factory
{
    /**
     * @return Response
     */
    public function lists(): Response
    {
        return $this->client->request(
            'GET',
            ['topic-permissions']
        );
    }

    /**
     * @param string $vhost
     * @param string $user
     * @return Response
     */
    public function get(string $vhost, string $user): Response
    {
        return $this->client->request(
            'GET',
            ['topic-permissions', urlencode($vhost), $user]
        );
    }

    /**
     * @param string $vhost
     * @param string $user
     * @param string $exchange
     * @param string $write
     * @param string $read
     * @return Response
     */
    public function put(
        string $vhost,
        string $user,
        string $exchange = 'amq.topic',
        string $write = '.*',
        string $read = '.*'
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['topic-permissions', urlencode($vhost), $user],
            null,
            [
                'exchange' => $exchange,
                'write' => $write,
                'read' => $read
            ]
        );
    }

    /**
     * @param string $vhost
     * @param string $user
     * @return Response
     */
    public function delete(string $vhost, string $user): Response
    {
        return $this->client->request(
            'DELETE',
            ['topic-permissions', urlencode($vhost), $user]
        );
    }
}