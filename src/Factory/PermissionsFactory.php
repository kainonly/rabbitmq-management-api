<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class PermissionsFactory extends Factory
{
    /**
     * A list of all permissions for all users.
     * @return Response
     */
    public function lists(): Response
    {
        return $this->client->request(
            'GET',
            ['permissions']
        );
    }

    /**
     * Get An individual permission of a user and virtual host
     * @param string $vhost
     * @param string $user
     * @return Response
     */
    public function get(string $vhost, string $user): Response
    {
        return $this->client->request(
            'GET',
            ['permissions', urlencode($vhost), $user]
        );
    }

    /**
     * Add An individual permission of a user and virtual host
     * @param string $vhost
     * @param string $user
     * @param string $configure
     * @param string $write
     * @param string $read
     * @return Response
     */
    public function put(
        string $vhost,
        string $user,
        string $configure = '.*',
        string $write = '.*',
        string $read = '.*'
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['permissions', urlencode($vhost), $user],
            null,
            [
                'configure' => $configure,
                'write' => $write,
                'read' => $read
            ]
        );
    }

    /**
     * Delete An individual permission of a user and virtual host
     * @param string $vhost
     * @param string $user
     * @return Response
     */
    public function delete(string $vhost, string $user): Response
    {
        return $this->client->request(
            'DELETE',
            ['permissions', urlencode($vhost), $user]
        );
    }
}