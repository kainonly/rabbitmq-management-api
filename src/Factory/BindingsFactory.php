<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class BindingsFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * BindingsFactory constructor.
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
            ['bindings', $this->vhost]
        );
    }

    /**
     * @param string $exchange
     * @param string $queue
     * @return Response
     */
    public function getBindingToQueue(string $exchange, string $queue): Response
    {
        return $this->client->request(
            'GET',
            ['bindings', $this->vhost, 'e', $exchange, 'q', $queue]
        );
    }

    /**
     * @param string $exchange
     * @param string $queue
     * @param string $routing_key
     * @param array $arguments
     * @return Response
     */
    public function setBindingToQueue(
        string $exchange,
        string $queue,
        string $routing_key = '',
        array $arguments = []
    ): Response
    {
        return $this->client->request(
            'POST',
            ['bindings', $this->vhost, 'e', $exchange, 'q', $queue],
            null,
            [
                'routing_key' => $routing_key,
                'arguments' => (object)$arguments
            ]
        );
    }

    /**
     * @param string $exchange
     * @param string $queue
     * @param string $routing_key
     * @return Response
     */
    public function getBindingFormRoutingKey(
        string $exchange,
        string $queue,
        string $routing_key = ''
    ): Response
    {
        return $this->client->request(
            'GET',
            ['bindings', $this->vhost, 'e', $exchange, 'q', $queue, $routing_key]
        );
    }

    /**
     * @param string $exchange
     * @param string $queue
     * @param string $routing_key
     * @return Response
     */
    public function deleteBindingFormRoutingKey(
        string $exchange,
        string $queue,
        string $routing_key = ''
    ): Response
    {
        return $this->client->request(
            'DELETE',
            ['bindings', $this->vhost, 'e', $exchange, 'q', $queue, $routing_key]
        );
    }
}