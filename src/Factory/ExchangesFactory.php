<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\ExchangeOption;
use RabbitMQ\API\Common\PublishOption;
use RabbitMQ\API\Common\Response;

class ExchangesFactory extends Factory
{
    /**
     * A list of all exchanges.
     * @param string $vhost
     * @return Response
     */
    public function lists(string $vhost = ''): Response
    {
        return $this->client->request(
            'GET',
            ['exchanges', urlencode($vhost)]
        );
    }

    /**
     * An individual exchange.
     * @param string $name
     * @param string $vhost
     * @return Response
     */
    public function get(string $name, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['exchanges', urlencode($vhost), $name]
        );
    }

    /**
     * PUT an exchange
     * @param string $name
     * @param ExchangeOption $option
     * @param string $vhost
     * @return Response
     */
    public function put(string $name, ExchangeOption $option, string $vhost): Response
    {
        return $this->client->request(
            'PUT',
            ['exchanges', urlencode($vhost), $name],
            null,
            $option->getBody()
        );
    }

    /**
     * DELETEing an exchange
     * @param string $name
     * @param string $vhost
     * @param bool $unused
     * @return Response
     */
    public function delete(string $name, string $vhost, bool $unused = true): Response
    {
        return $this->client->request(
            'DELETE',
            ['exchanges', urlencode($vhost), $name],
            [
                'if-unused' => $unused
            ]
        );
    }

    /**
     * A list of all bindings in which a given exchange is the source.
     * @param string $name
     * @param string $vhost
     * @return Response
     */
    public function getBindingsSource(string $name, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['exchanges', urlencode($vhost), $name, 'bindings', 'source']
        );
    }

    /**
     * A list of all bindings in which a given exchange is the destination.
     * @param string $name
     * @param string $vhost
     * @return Response
     */
    public function getBindingsDestination(string $name, string $vhost): Response
    {
        return $this->client->request(
            'GET',
            ['exchanges', urlencode($vhost), $name, 'bindings', 'destination']
        );
    }

    /**
     * Publish a message to a given exchange.
     * @param string $name
     * @param PublishOption $option
     * @param string $vhost
     * @return Response
     */
    public function publish(string $name, PublishOption $option, string $vhost): Response
    {
        return $this->client->request(
            'POST',
            ['exchanges', urlencode($vhost), $name, 'publish'],
            null,
            $option->getBody()
        );
    }

}