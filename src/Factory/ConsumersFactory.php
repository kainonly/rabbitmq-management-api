<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class ConsumersFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * ConsumersFactory constructor.
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
    public function lists(): Response
    {
        return $this->client->request(
            'GET',
            ['consumers', $this->vhost]
        );
    }
}