<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\ExchangeOption;
use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class QueuesFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * QueuesFactory constructor.
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
            ['queues', $this->vhost]
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
            ['queues', $this->vhost, $name]
        );
    }

    /**
     * @param string $name
     * @param ExchangeOption $option
     * @return Response
     */
    public function put(string $name, ExchangeOption $option): Response
    {
        return $this->client->request(
            'PUT',
            ['queues', $this->vhost, $name],
            null,
            $option->getBody()
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
            ['queues', $this->vhost, $name],
        );
    }


}