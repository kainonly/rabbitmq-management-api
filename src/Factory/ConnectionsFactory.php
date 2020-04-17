<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class ConnectionsFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * ConnectionsFactory constructor.
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
            !empty($this->vhost) ? ['vhosts', $this->vhost, 'connections'] : ['connections']
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
            ['connections', $name]
        );
    }

    /**
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
     * @param $name
     * @return Response
     */
    public function getChannel($name): Response
    {
        return $this->client->request(
            'GET',
            ['connections', $name, 'channels']
        );
    }
}