<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class ChannelsFactory extends Factory
{
    /**
     * A list of all open channels.
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            !empty($vhost) ? ['vhosts', urlencode($vhost), 'channels'] : ['channels']
        );
    }

    /**
     * Details about an individual channel.
     * @param $name
     * @return Response
     */
    public function get($name): Response
    {
        return $this->client->request(
            'GET',
            ['channels', $name]
        );
    }
}