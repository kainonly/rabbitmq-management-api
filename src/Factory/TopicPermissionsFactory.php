<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class TopicPermissionsFactory extends Factory
{
    /**
     * A list of all topic permissions for all users.
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
     * Get Topic permissions for a user and virtual host.
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
     * Add Topic permissions for a user and virtual host.
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
     * Delete Topic permissions for a user and virtual host.
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