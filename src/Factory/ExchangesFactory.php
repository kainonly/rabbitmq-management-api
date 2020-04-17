<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class ExchangesFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * ExchangesFactory constructor.
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
            ['exchanges', $this->vhost]
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
            ['exchanges', $this->vhost, $name]
        );
    }

    public function put(string $name): Response
    {
        return $this->client->request(
            'PUT',
            ['exchanges', $this->vhost, $name],
            null,
            [

            ]
        );
    }

}