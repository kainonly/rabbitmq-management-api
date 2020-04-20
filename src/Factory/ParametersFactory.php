<?php
declare(strict_types=1);

namespace RabbitMQ\API\Factory;

use RabbitMQ\API\Common\HttpClientInterface;
use RabbitMQ\API\Common\Response;

class ParametersFactory extends Factory
{
    /**
     * @var string
     */
    private string $vhost;

    /**
     * ParametersFactory constructor.
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
     * @param string|null $component
     * @return Response
     */
    public function lists(?string $component = null): Response
    {
        return $this->client->request(
            'GET',
            ['parameters', $component, $this->vhost]
        );
    }

    /**
     * @param string $component
     * @param string $name
     * @return Response
     */
    public function get(string $component, string $name): Response
    {
        return $this->client->request(
            'GET',
            ['parameters', $component, $this->vhost, $name]
        );
    }

    /**
     * @param string $component
     * @param string $name
     * @param string $value
     * @return Response
     */
    public function put(
        string $component,
        string $name,
        string $value
    ): Response
    {
        return $this->client->request(
            'PUT',
            ['parameters', $component, $this->vhost, $name],
            null,
            [
                'vhost' => $this->vhost,
                'component' => $component,
                'name' => $name,
                'value' => $value
            ]
        );
    }

    /**
     * @param string $component
     * @param string $name
     * @return Response
     */
    public function delete(string $component, string $name): Response
    {
        return $this->client->request(
            'DELETE',
            ['parameters', $component, $this->vhost, $name]
        );
    }
}