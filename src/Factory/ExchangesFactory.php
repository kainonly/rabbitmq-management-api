<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\ExchangeOption;
use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\PublishOption;
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

    /**
     * @param string $name
     * @param ExchangeOption $option
     * @return Response
     */
    public function put(string $name, ExchangeOption $option): Response
    {
        return $this->client->request(
            'PUT',
            ['exchanges', $this->vhost, $name],
            null,
            $option->getBody()
        );
    }

    /**
     * @param string $name
     * @param bool $unused
     * @return Response
     */
    public function delete(string $name, bool $unused = true): Response
    {
        return $this->client->request(
            'DELETE',
            ['exchanges', $this->vhost, $name],
            [
                'if-unused' => $unused
            ]
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function getBindingsSource(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['exchanges', $this->vhost, $name, 'bindings', 'source']
        );
    }

    /**
     * @param string $name
     * @return Response
     */
    public function getBindingsDestination(string $name): Response
    {
        return $this->client->request(
            'GET',
            ['exchanges', $this->vhost, $name, 'bindings', 'destination']
        );
    }

    /**
     * @param string $name
     * @param PublishOption $option
     * @return Response
     */
    public function publish(string $name, PublishOption $option): Response
    {
        return $this->client->request(
            'POST',
            ['exchanges', $this->vhost, $name, 'publish'],
            null,
            $option->getBody()
        );
    }

}