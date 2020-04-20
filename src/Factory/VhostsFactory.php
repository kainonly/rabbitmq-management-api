<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class VhostsFactory extends Factory
{
    /**
     * @return Response
     */
    public function lists(): Response
    {
        return $this->client->request(
            'GET',
            ['vhosts']
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
            ['vhosts', urlencode($name)]
        );
    }

    /**
     * @param string $name
     * @param string $description
     * @param array $tags
     * @return Response
     */
    public function put(
        string $name,
        string $description = '',
        array $tags = []
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['vhosts', urlencode($name)],
            null,
            [
                'description' => $description,
                'tags' => implode(',', $tags)
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
            ['vhosts', urlencode($name)]
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function getPermissions(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['vhosts', urlencode($name), 'permissions']
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function getTopicPermissions(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['vhosts', urlencode($name), 'topic-permissions']
        );
    }

    /**
     * @param string $name
     * @param string $node
     * @return Response
     */
    public function start(string $name, string $node): Response
    {
        return $this->client->request(
            'POST',
            ['vhosts', urlencode($name), 'start', $node]
        );
    }
}