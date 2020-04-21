<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class ConnectionsFactory extends Factory
{
    /**
     * A list of all open connections.
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            !empty($vhost) ? ['vhosts', urlencode($vhost), 'connections'] : ['connections']
        );
    }

    /**
     * An individual connection
     * @param $name
     * @return Response
     */
    public function get($name): Response
    {
        return $this->client->request(
            'GET',
            ['connections', $name]
        );
    }

    /**
     * close the connection
     * @param $name
     * @return Response
     */
    public function delete($name): Response
    {
        return $this->client->request(
            'DELETE',
            ['connections', $name]
        );
    }

    /**
     * List of all channels for a given connection
     * @param $name
     * @return Response
     */
    public function getChannels($name): Response
    {
        return $this->client->request(
            'GET',
            ['connections', $name, 'channels']
        );
    }
}