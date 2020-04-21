<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class UsersFactory extends Factory
{
    /**
     * A list of all users.
     * @param bool $without_permissions
     * @return Response
     */
    public function lists(bool $without_permissions = false): Response
    {
        return $this->client->request(
            'GET',
            ['users', $without_permissions ? 'without-permissions' : null]
        );
    }

    /**
     * Bulk deletes a list of users
     * @param array $users
     * @return Response
     */
    public function bulkDelete(array $users): Response
    {
        return $this->client->request(
            'POST',
            ['users', 'bulk-delete'],
            null,
            [
                'users' => $users
            ]
        );
    }

    /**
     * Get An individual user.
     * @param string $name
     * @return Response
     */
    public function get(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['users', $name]
        );
    }

    /**
     * Add An individual user.
     * @param string $name
     * @param string $password
     * @param array $tags
     * @return Response
     */
    public function put(
        string $name,
        string $password = '',
        array $tags = []
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['users', $name],
            null,
            [
                'password' => $password,
                'tags' => implode(',', $tags)
            ]
        );
    }

    /**
     * Delete An individual user.
     * @param string $name
     * @return Response
     */
    public function delete(string $name): Response
    {
        return $this->client->request(
            'DELETE',
            ['users', $name]
        );
    }


    /**
     * A list of all permissions for a given user.
     * @param string $name
     * @return Response
     */
    public function getPermissions(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['users', $name, 'permissions']
        );
    }

    /**
     *    A list of all topic permissions for a given user.
     * @param string $name
     * @return Response
     */
    public function getTopicPermissions(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['users', $name, 'topic-permissions']
        );
    }
}