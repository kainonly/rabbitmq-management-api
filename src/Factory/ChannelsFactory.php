<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class ChannelsFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * ChannelsFactory constructor.
     * @param HttpClientInterface $client
     * @param string $vhost
     */
    public function __construct(
        HttpClientInterface $client,
        string $vhost
    )
    {
        parent::__construct($client);
        $this->vhost = urlencode($vhost);
    }

    /**
     * @return Response
     */
    public function all(): Response
    {
        return $this->client->request(
            'GET',
            !empty($this->vhost) ? ['vhosts', $this->vhost, 'channels'] : ['channels']
        );
    }

    /**
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