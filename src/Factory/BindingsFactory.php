<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\Response;

class BindingsFactory extends Factory
{
    /**
     * A list of all bindings.
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['bindings', urlencode($vhost)]
        );
    }

    /**
     * A list of all bindings between an exchange and a queue
     * @param string $exchange
     * @param string $queue
     * @param string $vhost
     * @return Response
     */
    public function getBindingToQueue(string $exchange, string $queue, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['bindings', urlencode($vhost), 'e', $exchange, 'q', $queue]
        );
    }

    /**
     * create a new binding
     * @param string $exchange
     * @param string $queue
     * @param string $vhost
     * @param string $routing_key
     * @param array $arguments
     * @return Response
     */
    public function setBindingToQueue(
        string $exchange,
        string $queue,
        string $vhost,
        string $routing_key = '',
        array $arguments = []
    ): Response
    {
        return $this->client->request(
            'POST',
            ['bindings', urlencode($vhost), 'e', $exchange, 'q', $queue],
            null,
            [
                'routing_key' => $routing_key,
                'arguments' => (object)$arguments
            ]
        );
    }

    /**
     * Get an individual binding between an exchange and a queue
     * @param string $exchange
     * @param string $queue
     * @param string $vhost
     * @param string $routing_key
     * @return Response
     */
    public function getBindingToQueueFormRoutingKey(
        string $exchange,
        string $queue,
        string $vhost,
        string $routing_key = ''
    ): Response
    {
        return $this->client->request(
            'GET',
            ['bindings', urlencode($vhost), 'e', $exchange, 'q', $queue, $routing_key]
        );
    }

    /**
     * Delete an individual binding between an exchange and a queue
     * @param string $exchange
     * @param string $queue
     * @param string $vhost
     * @param string $routing_key
     * @return Response
     */
    public function deleteBindingToQueueFormRoutingKey(
        string $exchange,
        string $queue,
        string $vhost,
        string $routing_key = '~'
    ): Response
    {
        return $this->client->request(
            'DELETE',
            ['bindings', urlencode($vhost), 'e', $exchange, 'q', $queue, $routing_key]
        );
    }

    /**
     * A list of all bindings between two exchanges
     * @param string $source
     * @param string $destination
     * @param string $vhost
     * @return Response
     */
    public function getBindingToExchange(
        string $source,
        string $destination,
        string $vhost
    ): Response
    {
        return $this->client->request(
            'GET',
            ['bindings', urlencode($vhost), 'e', $source, 'e', $destination]
        );
    }

    /**
     * create a new binding
     * @param string $source
     * @param string $destination
     * @param string $vhost
     * @param string $routing_key
     * @param array $arguments
     * @return Response
     */
    public function setBindingToExchange(
        string $source,
        string $destination,
        string $vhost,
        string $routing_key = '',
        array $arguments = []
    ): Response
    {
        return $this->client->request(
            'POST',
            ['bindings', urlencode($vhost), 'e', $source, 'e', $destination],
            null,
            [
                'routing_key' => $routing_key,
                'arguments' => (object)$arguments
            ]
        );
    }

    /**
     * Get an individual binding between two exchanges
     * @param string $source
     * @param string $destination
     * @param string $vhost
     * @param string $routing_key
     * @return Response
     */
    public function getBindingToExchangeFormRoutingKey(
        string $source,
        string $destination,
        string $vhost,
        string $routing_key = ''
    ): Response
    {
        return $this->client->request(
            'GET',
            ['bindings', urlencode($vhost), 'e', $source, 'e', $destination, $routing_key]
        );
    }

    /**
     * Delete an individual binding between two exchanges
     * @param string $source
     * @param string $destination
     * @param string $vhost
     * @param string $routing_key
     * @return Response
     */
    public function deleteBindingToExchangeFormRoutingKey(
        string $source,
        string $destination,
        string $vhost,
        string $routing_key = '~'
    ): Response
    {
        return $this->client->request(
            'DELETE',
            ['bindings', urlencode($vhost), 'e', $source, 'e', $destination, $routing_key]
        );
    }
}